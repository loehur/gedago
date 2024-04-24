<?php

class Portfolio extends Controller
{
   function portfolio()
   {
      if (isset($_SESSION['log'])) {
         $log = $_SESSION['log'];
         $active = $this->db(0)->get_where_row("portfolio", "user_id = '" . $log['user_id'] . "' AND port_status = 0");
         $saldo_portfolio = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND ref = '" . $active['port_id'] . "' AND tr_status <> 2", 0);
         $active['saldo'] = $saldo_portfolio['amount'];
         return $active;
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
}
