<?php

class Marketplace extends Controller
{
   public function __construct()
   {
      $cek = $this->func("Session")->cek();
      if ($cek == 0) {
         header("Location: " . PC::BASE_URL . "Login");
         exit();
      }
   }

   public function index()
   {
      $data = [
         'title' => "Store",
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content($parse)
   {
      $log = $_SESSION['log'];
      $d = $this->db(0)->get_where_row("portfolio", "user_id = '" . $log['user_id'] . "' AND port_status = 0");
      $data = $this->func("Portfolio")->portfolio($d);
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function invest()
   {
      $log = $_SESSION['log'];

      $level = 0;
      $topup = $_POST['topup'];
      $target_level = $_POST['level'];
      $topup = (int) filter_var($topup, FILTER_SANITIZE_NUMBER_INT);
      $total_invest = $topup;

      //cek saldo
      $saldo = $this->func("Balance")->saldo();
      if ($saldo < $topup) {
         echo "Saldo tidak cukup!";
         exit();
      }

      //cek portfolio jika ada saldo portfolio
      $d = $this->db(0)->get_where_row("portfolio", "user_id = '" . $log['user_id'] . "' AND port_status = 0");
      $port_balance = $this->func("Portfolio")->portfolio($d);

      if (!isset($port_balance['saldo'])) {
         $port_saldo = 0;
      } else {
         $port_saldo = $port_balance['saldo'];
      }

      $newPort = true;
      $port_id = "P" . date("Ymdhis") . rand(0, 9);
      $min_topup = 10000000000;

      if ($port_saldo > 0) {
         $total_invest = $topup + $port_saldo;

         foreach ($_SESSION['config']['level'] as $l) {
            if ($target_level == $l['level']) {
               $days = $l['days'];
               $min_topup = $l['topup'];
               $max_dw = $days * $l['benefit'][1]['qty'];
            }
         }

         if ($port_balance['data']['level'] <> $target_level) {
            $newPort = true;

            //tutup investasi lama
            $close = $this->func("Portfolio")->close($port_balance);
            if ($close <> "") {
               echo $close;
               exit();
            }
         } else {
            $port_id = $port_balance['data']['port_id'];
            $newPort = false;
         }
      } else {
         foreach ($_SESSION['config']['level'] as $l) {
            if ($target_level == $l['level']) {
               $days = $l['days'];
               $max_dw = $days * $l['benefit'][1]['qty'];
               $min_topup = $l['topup'];
            }
         }
      }

      $level = $target_level;
      if ($total_invest < $min_topup) {
         echo "Saldo tidak cukup!";
         exit();
      }

      if ($level == 0) {
         echo "Nominal dibawah batas minimum Investasi";
         exit();
      }


      if ($newPort == true) {
         $Date = date("Y-m-d");
         $expired_date = date('Y-m-d', strtotime($Date . ' + ' . $days . ' days'));
         $cols = "port_id, level, expired_date, user_id, max_dc, max_dw, insertTime";
         $vals = "'" . $port_id . "'," . $level . ", '" . $expired_date . "','" . $_SESSION['log']['user_id'] . "','" . $days . "','" . $max_dw . "','" . $GLOBALS['now'] . "'";
         $in = $this->db(0)->insertCols("portfolio", $cols, $vals);
         if ($in['errno'] <> 0) {
            $this->model('Log')->write($in['error']);
            exit();
         }
      }

      if ($newPort == true) {
         $amount_invest = $total_invest;
      } else {
         $amount_invest = $topup;
      }

      $cols = "flow, balance_type, user_id, ref, amount, tr_status, insertTime";
      $vals = "2,10,'" . $_SESSION['log']['user_id'] . "','" . $port_id . "'," . $amount_invest . ",1,'" . $GLOBALS['now'] . "'";
      $in = $this->db(0)->insertCols("balance", $cols, $vals);
      if ($in['errno'] <> 0) {
         $this->model('Log')->write($in['error']);
         $this->reset_error($port_id);
         exit();
      }

      $up = $this->db(0)->get_where_row("user", "user_id = '" . $_SESSION['log']['up'] . "'");
      if (isset($up['user_id'])) {
         $cols = "flow, balance_type, user_id, ref, amount, tr_status, insertTime";
         $vals = "1,22,'" . $up['user_id'] . "','" . $port_id . "'," . $topup * ($_SESSION['config']['setting']['up1_fee']['value'] / 100) . ",1,'" . $GLOBALS['now'] . "'";
         $in = $this->db(0)->insertCols("balance", $cols, $vals);
         if ($in['errno'] <> 0) {
            $this->model('Log')->write($in['error']);
            $this->reset_error($port_id);
            exit();
         }

         $up2 = $this->db(0)->get_where_row("user", "user_id = '" . $up['up'] . "'");
         if (isset($up2['user_id'])) {
            $cols = "flow, balance_type, user_id, ref, amount, tr_status,insertTime";
            $vals = "1,23,'" . $up2['user_id'] . "','" . $port_id . "'," . $topup * ($_SESSION['config']['setting']['up2_fee']['value'] / 100) . ",1,'" . $GLOBALS['now'] . "'";
            $in2 = $this->db(0)->insertCols("balance", $cols, $vals);
            if ($in2['errno'] <> 0) {
               $this->model('Log')->write($in2['error']);
               $this->reset_error($port_id);
               exit();
            }
         }
      }
   }

   function reset_error($port_id)
   {
      $this->db(0)->delete("balance", "ref = '" . $port_id . "'");
      $this->db(0)->delete("portfolio", "port_id = '" . $port_id . "'");
   }
}
