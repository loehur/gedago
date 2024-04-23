<?php

class Balance extends Controller
{
   function saldo()
   {
      $log = $_SESSION['log'];
      $deposit = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND flow = 1 AND tr_status = 1", 0);
      $invest = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND flow = 2 AND tr_status <> 2", 0);

      $deposit = $deposit['amount'] == '' ? 0 : $deposit['amount'];
      $invest = $invest['amount'] == '' ? 0 : $invest['amount'];

      $saldo = $deposit - $invest;
      return $saldo;
   }
}
