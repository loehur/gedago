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
      if (!isset($_SESSION['portfolio']['user_id'])) {
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
      if (!isset($_SESSION['portfolio']['user_id'])) {
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

   function checkin()
   {
      $log = $_SESSION['log'];
      if (!isset($_SESSION['portfolio']['user_id'])) {
         $_SESSION['portfolio'] = $this->func("Portfolio")->portfolio();
      }
      $data = $_SESSION['portfolio'];

      foreach (PC::LEVEL as $pl) {
         if ($pl['level'] == $data['level']) {
            $fee = $pl['benefit'][0]['fee'];
            $days = $pl['days'];
         }
      }

      if (isset($data['port_id'])) {
         $count = $this->db(0)->count_where("daily_checkin", "ref = '" . $data['port_id'] . "'");
         if ($count < $days) {
            $cek_today = $this->db(0)->count_where("daily_checkin", "ref = '" . $data['port_id'] . "' AND updateTime LIKE '%" . date("Y-m-d") . "%'");
            if ($cek_today == 0) {
               $in = $this->db(0)->insertCols("daily_checkin", "ref", "'" . $data['port_id'] . "'");
               if ($in['errno'] == 0) {
                  $cekfeedaily = $this->db(0)->count_where("balance", "balance_type = 20 AND ref = '" . $data['port_id'] . "' AND insertTime LIKE '%" . date("Y-m-d") . "%'");
                  if ($cekfeedaily == 0) {
                     $fee_am = ($fee / 100) * $data['saldo'];

                     $cols = "user_id, balance_type, ref, amount, flow";
                     $vals = "'" . $log['user_id'] . "',20,'" . $data['port_id'] . "'," . $fee_am . ",1";
                     $in2 = $this->db(0)->insertCols("balance", $cols, $vals);
                     if ($in2['errno'] == 0) {
                        echo 0;
                     } else {
                        $this->db(0)->delete_where("daily_checkin", "ref = '" . $data['port_id'] . "'");
                        $this->model('Log')->write($in2['error']);
                        echo "Error, hubungi CS";
                        exit();
                     }
                  }
               } else {
                  $this->db(0)->delete_where("daily_checkin", "ref = '" . $data['port_id'] . "'");
                  $this->db(0)->delete_where("balance", "ref = '" . $data['port_id'] . "'");
                  $this->model('Log')->write($in['error']);
                  echo "Error, hubungi CS";
               }
            } else {
               echo "Anda sudah checkin Hari ini, silahkan reload page";
            }
         } else {
            $up = $this->db(0)->update("portfolio", "port_status = 1", "user_id = '" . $log['user_id'] . "' AND port_id = '" . $data['port_id'] . "'");
            if ($up['errno'] == 0) {
               $_SESSION['portfolio'] = $this->func("Portfolio")->portfolio();
            } else {
               $this->model('Log')->write($up['error'] . " - ketika checkin melebihi batas");
            }
            echo "Anda telah melebihi batas Checkin";
         }
      } else {
         echo "Session Error, Hubungi CS";
      }
   }
}
