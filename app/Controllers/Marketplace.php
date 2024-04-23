<?php

class Marketplace extends Controller
{
   public function __construct()
   {
   }

   public function index()
   {
      $data = [
         'title' => __CLASS__,
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content($parse)
   {
      $data = PC::LEVEL;
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function invest()
   {
      $level = 0;
      $topup = $_POST['topup'];
      $topup = (int) filter_var($topup, FILTER_SANITIZE_NUMBER_INT);

      //cek saldo
      $saldo = $this->func("Balance")->saldo();
      if ($saldo < $topup) {
         echo "Saldo tidak cukup";
         exit();
      }

      $cTop = 0;
      foreach (PC::LEVEL as $l) {
         if ($cTop <= $l['topup']) {
            $cTop = $l['topup'];
         }

         if ($topup >= $cTop) {
            $level = $l['level'];
            $daily_watch = $l['benefit'][1]['qty'];
            $days = $l['days'];
         }
      }

      if ($level == 0) {
         echo "Nominal dibawah batas minimum Investasi";
         exit();
      }

      $port_id = "P" . date("Ymdhis") . rand(0, 9);
      $Date = date("Y-m-d");
      $expired_date = date('Y-m-d', strtotime($Date . ' + ' . $days . ' days'));

      $cols = "port_id, level, expired_date, daily_watch, user_id";
      $vals = "'" . $port_id . "'," . $level . ", '" . $expired_date . "'," . $daily_watch . ",'" . $_SESSION['log']['user_id'] . "'";
      $in = $this->db(0)->insertCols("portfolio", $cols, $vals);
      if ($in['errno'] <> 0) {
         $this->model('Log')->write($in['error']);
         exit();
      }

      $cols = "flow, balance_type, user_id, ref, amount";
      $vals = "2,10,'" . $_SESSION['log']['user_id'] . "','" . $port_id . "'," . $topup;
      $in = $this->db(0)->insertCols("balance", $cols, $vals);
      if ($in['errno'] <> 0) {
         $this->model('Log')->write($in['error']);
         $this->reset_error($port_id);
         exit();
      }

      $up = $this->db(0)->get_where_row("user", "user_id = '" . $_SESSION['log']['up'] . "'");
      if (isset($up['user_id'])) {
         $cols = "flow, balance_type, user_id, ref, amount";
         $vals = "1,22,'" . $up['user_id'] . "','" . $port_id . "'," . $topup * (PC::SETTING['up1_fee'] / 100);
         $in = $this->db(0)->insertCols("balance", $cols, $vals);
         if ($in['errno'] <> 0) {
            $this->model('Log')->write($in['error']);
            $this->reset_error($port_id);
            exit();
         }

         $up2 = $this->db(0)->get_where_row("user", "user_id = '" . $up['up'] . "'");
         if (isset($up2['user_id'])) {
            $cols = "flow, balance_type, user_id, ref, amount";
            $vals = "1,23,'" . $up2['user_id'] . "','" . $port_id . "'," . $topup * (PC::SETTING['up2_fee'] / 100);
            $in2 = $this->db(0)->insertCols("balance", $cols, $vals);
            if ($in2['errno'] <> 0) {
               $this->model('Log')->write($in2['error']);
               $this->reset_error($port_id);
               exit();
            }
         }
      }

      $_SESSION['portfolio'] = $this->func("Portfolio")->portfolio();
   }

   function reset_error($port_id)
   {
      $this->db(0)->delete("balance", "ref = '" . $port_id . "'");
      $this->db(0)->delete("portfolio", "port_id = '" . $port_id . "'");
   }
}
