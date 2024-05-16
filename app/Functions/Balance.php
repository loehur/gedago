<?php

class Balance extends Controller
{
   function saldo()
   {
      $log = $_SESSION['log'];

      //deposit dan wd
      $deposit = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND flow = 1 AND balance_type = 1 AND tr_status = 1", 0)['amount'] ?? 0;
      $wd = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND flow = 2 AND balance_type = 1 AND tr_status <> 2", 0)['amount'] ?? 0;

      //investing
      $invest_wd = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND flow = 1 AND balance_type = 10 AND tr_status <> 2", 0)['amount'] ?? 0;
      $invest = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND flow = 2 AND balance_type = 10 AND tr_status <> 2", 0)['amount'] ?? 0;

      //fee downline
      $fee_down = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND flow = 1 AND (balance_type BETWEEN 22 AND 23) AND tr_status <> 2", 0)['amount'] ?? 0;
      $fee_dc = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND flow = 1 AND balance_type = 50 AND tr_status <> 2", 0)['amount'] ?? 0;
      $fee_dw = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND flow = 1 AND balance_type = 51 AND tr_status <> 2", 0)['amount'] ?? 0;

      $saldo = ($deposit + $fee_down + $fee_dc + $fee_dw + $invest_wd) - ($invest + $wd);
      return $saldo;
   }
}
