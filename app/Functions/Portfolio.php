<?php

class Portfolio extends Controller
{
   function portfolio()
   {
      $log = $_SESSION['log'];
      $active = $this->db(0)->get_where_row("portfolio", "user_id = '" . $log['user_id'] . "' AND port_status = 0");
      $saldo_portfolio = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND tr_status <> 2", 0);
      $active['saldo'] = $saldo_portfolio['amount'];
      return $active;
   }
}
