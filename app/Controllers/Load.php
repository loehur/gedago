<?php

class Load extends Controller
{
   function account()
   {
      if (isset($_SESSION['log']['hp'])) {
         $where = "hp = '" . $_SESSION['log']['hp'] . "'";
         $cust = $this->db(0)->get_where_row("customer", $where);
         if (!isset($_SESSION['log']['customer_id'])) {
            $_SESSION['log']['customer_id'] = $cust['customer_id'];
         }
         if (isset($cust['name'])) {
            echo ucfirst(strtok($cust['name'], " "));
         } else {
            unset($_SESSION['log']);
         }
      } else {
         echo "Login";
      }
   }

   function spinner($tipe)
   {
      $this->load("Spinner", $tipe);
   }

   function balance()
   {
      $log = $_SESSION['log'];
      $deposit = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $log['user_id'] . "' AND flow = 1 AND tr_status = 1", 0);
      echo $deposit['amount'] == '' ? 0 : number_format($deposit['amount']);
   }
}
