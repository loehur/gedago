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

   function level_name($level = 0)
   {
      if ($level <> 0) {
         foreach (PC::LEVEL as $l) {
            if ($l['level'] == $level) {
               echo $l['name'];
            }
         }
      } else {
         echo "Basic";
      }
   }

   function daily_task($level = 0)
   {
      if ($level <> 0) {
         foreach (PC::LEVEL as $l) {
            if ($l['level'] == $level) {
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
      $d = $this->db(0)->get_where_row("portfolio", "user_id = '" . $log['user_id'] . "' AND port_status = 0");
      $port_data = $this->func("Portfolio")->portfolio($d);

      //cek_expired
      $expired_date = $d['expired_date'];
      $expired = $this->func("Portfolio")->cek_expired($expired_date);
      if ($expired <= 0) {
         $close = $this->func("Portfolio")->close($port_data);
         if ($close <> "") {
            echo $close;
            exit();
         }
      }

      $data = $port_data['data'];

      foreach (PC::LEVEL as $pl) {
         if ($pl['level'] == $data['level']) {
            $fee = $pl['benefit'][0]['fee'];
            $days = $pl['days'];
         }
      }

      if (isset($data['port_id'])) {
         $count = $this->db(0)->count_where("daily_checkin", "ref = '" . $data['port_id'] . "'");
         if ($count < $days) {
            $cek_today = $this->db(0)->count_where("daily_checkin", "ref = '" . $data['port_id'] . "' AND insertTime LIKE '%" . date("Y-m-d") . "%'");
            if ($cek_today == 0) {
               $dc_id = "DC" . date("Ymdhis") . rand(0, 9);
               $fee_am = ($fee / 100) * $port_data['saldo'];
               $in = $this->db(0)->insertCols("daily_checkin", "dc_id, user_id, ref, fee", "'" . $dc_id . "','" . $log['user_id'] . "','" . $data['port_id'] . "'," . $fee_am);
               if ($in['errno'] <> 0) {
                  $this->model('Log')->write($in['error']);
                  echo "Error, hubungi CS";
               }
            } else {
               echo "Anda sudah checkin Hari ini, silahkan reload page";
            }
         } else {
            echo "Anda telah melebihi batas Checkin";
            exit();
         }
      } else {
         $this->model('Log')->write("Error Checkin Function");
         echo "Session Error, Hubungi CS";
         exit();
      }
   }

   function watch($video_id)
   {
      $log = $_SESSION['log'];
      $d = $this->db(0)->get_where_row("portfolio", "user_id = '" . $log['user_id'] . "' AND port_status = 0");
      $port_data = $this->func("Portfolio")->portfolio($d);
      $data = $port_data['data'];

      foreach (PC::LEVEL as $pl) {
         if ($pl['level'] == $data['level']) {
            $fee = $pl['benefit'][1]['fee'];
            $qty = $pl['benefit'][1]['qty'];
         }
      }

      $today = date("Y-m-d");

      if (isset($data['port_id'])) {
         $count = $this->db(0)->count_where("daily_watch", "ref = '" . $data['port_id'] . "' AND insertTime LIKE '%" . $today . "%'");
         if ($count < $qty) {
            $dw_id = "DW" . date("Ymdhis") . rand(0, 9);
            $fee_am = ($fee / 100) * $port_data['saldo'];
            $in = $this->db(0)->insertCols("daily_watch", "dw_id, user_id, ref, video_id, fee", "'" . $dw_id . "','" . $log['user_id'] . "','" . $data['port_id'] . "'," . $video_id . "," . $fee_am);
            if ($in['errno'] <> 0) {
               $this->model('Log')->write($in['error']);
               echo "Error, hubungi CS";
               exit();
            }
         } else {
            echo "Anda telah melebihi batas Menonton";
            exit();
         }
      } else {
         $this->model('Log')->write("Error watch function");
         echo "Session Error, Hubungi CS";
         exit();
      }
   }
}
