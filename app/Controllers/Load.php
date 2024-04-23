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
      echo number_format($this->func("Balance")->saldo());
   }

   function level_name()
   {
      if (!isset($_SESSION['portfolio'])) {
         $_SESSION['portfolio'] = $this->func("Portfolio")->portfolio();
      }
      $data = $_SESSION['portfolio'];

      if (isset($data['level'])) {
         foreach (PC::LEVEL as $l) {
            if ($l['level'] == $data['level']) {
               $_SESSION['portfolio']['name'] = $l['name'];
               echo $l['name'];
            }
         }
      } else {
         echo "Basic";
      }
   }

   function daily_task()
   {
      if (!isset($_SESSION['portfolio'])) {
         $_SESSION['portfolio'] = $this->func("Portfolio")->portfolio();
      }
      $data = $_SESSION['portfolio'];

      if (isset($data['level'])) {
         foreach (PC::LEVEL as $l) {
            if ($l['level'] == $data['level']) {
               echo $l['benefit'][1]['qty'];
            }
         }
      } else {
         echo 0;
      }
   }
}
