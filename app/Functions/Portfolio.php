<?php

class Portfolio extends Controller
{
   function portfolio()
   {
      if (isset($_SESSION['log'])) {
         $log = $_SESSION['log'];
         $active = $this->db(0)->get_where_row("portfolio", "user_id = '" . $log['user_id'] . "' AND port_status = 0");
         if (isset($active['port_id'])) {
            $saldo_portfolio = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND balance_type = 10 AND flow = 2 AND ref = '" . $active['port_id'] . "' AND tr_status <> 2", 0);
            $total_portfolio = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND (balance_type BETWEEN 20 AND 23) AND ref = '" . $active['port_id'] . "' AND tr_status <> 2", 0);
            $active['saldo'] = $saldo_portfolio['amount'];
            $active['fee'] = $total_portfolio['amount'];
            return $active;
         } else {
            return [];
         }
      } else {
         return [];
      }
   }

   function daily_checkin()
   {
      if (isset($_SESSION['log'])) {
         if (!isset($_SESSION['portfolio']['user_id'])) {
            $_SESSION['portfolio'] = $this->func("Portfolio")->portfolio();
         }
         $data = $_SESSION['portfolio'];

         $c = [];
         if (isset($data['port_id'])) {
            $c = $this->db(0)->get_where_row("daily_checkin", "ref = '" . $data['port_id'] . "'");
         }
         return $c;
      } else {
         return [];
      }
   }

   function cek_expired($expired_date)
   {
      $hari_ini = date("Y-m-d");
      $start_date = new DateTime($hari_ini);
      $end_date = $start_date->diff(new DateTime($expired_date));
      if ($end_date->days > 0) {
         return 1;
      } else {
         return 0;
      }
   }

   function daily_fee($porto_id)
   {
      $daily_cek = $this->db(0)->get_where("daily_checkin", "ref = '" . $porto_id . "'");
      $data = [];
      foreach ($daily_cek as $dc) {
         $get = $this->db(0)->get_where_row("balance", "ref = '" . $dc['dc_id'] . "'");
         array_push($data, $get);
      }
      return $data;
   }
}
