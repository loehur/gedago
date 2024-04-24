<?php

class Balance extends Controller
{
   function saldo()
   {
      $log = $_SESSION['log'];
      $deposit = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND flow = 1 AND balance_type = 1 AND tr_status = 1", 0);
      $invest = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND flow = 2 AND balance_type = 10 AND tr_status <> 2", 0);
      $invest_wd = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND flow = 1 AND balance_type = 10", 0);

      $deposit = $deposit['amount'] == '' ? 0 : $deposit['amount'];
      $invest = $invest['amount'] == '' ? 0 : $invest['amount'];
      $invest_wd = $invest_wd['amount'] == '' ? 0 : $invest_wd['amount'];

      $saldo = ($deposit + $invest_wd) - $invest;
      return $saldo;
   }
}
