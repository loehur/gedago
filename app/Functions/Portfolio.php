<?php

class Portfolio extends Controller
{
   function portfolio()
   {
      $port['saldo'] = 0;
      $port['fee_dc'] = 0;
      $port['fee_dw'] = 0;
      if (isset($_SESSION['log'])) {
         $log = $_SESSION['log'];
         $port['data'] = $this->db(0)->get_where_row("portfolio", "user_id = '" . $log['user_id'] . "' AND port_status = 0");
         $data = $port['data'];
         if (isset($data['port_id'])) {
            $port['saldo'] = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND balance_type = 10 AND flow = 2 AND ref = '" . $data['port_id'] . "' AND tr_status <> 2", 0)['amount'];

            $dc_data = $this->db(0)->get_where("daily_checkin", "ref = '" . $data['port_id'] . "'");
            foreach ($dc_data as $dd) {
               $port['fee_dc'] += $this->db(0)->get_where_row("balance", "user_id = '" . $log['user_id'] . "' AND balance_type = 20 AND ref = '" . $dd['dc_id'] . "' AND tr_status <> 2")['amount'];
            }
         }
      }

      return $port;
   }

   function daily_checkin()
   {
      if (isset($_SESSION['log'])) {
         $data = $this->func("Portfolio")->portfolio();

         $c = [];
         if (isset($data['data']['port_id'])) {
            $c = $this->db(0)->get_where_row("daily_checkin", "ref = '" . $data['data']['port_id'] . "'");
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

   function porto_fee($user_id, $port_id)
   {
      //fee_daily
      $daily_fee = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $user_id . "' AND (balance_type BETWEEN 20 AND 23) AND ref = '" . $port_id . "' AND tr_status <> 2", 0);
      if (isset($daily_fee['amount'])) {
         if ($daily_fee['amount'] <> "") {
            $fee = $daily_fee['amount'];
         } else {
            $fee = 0;
         }
      } else {
         $fee = 0;
      }

      return $fee;
   }
}
