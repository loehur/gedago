<?php

class Cron extends Controller
{
   function port_expired()
   {
      $data = $this->db(0)->get_where("portfolio", "port_status = 0");
      foreach ($data as $d) {
         $expired_date = $d['expired_date'];
         $expired = $this->func("Portfolio")->cek_expired($expired_date);

         if ($expired <= 0) {
            $port_bal = $this->func("Portfolio")->portfolio($d);
            $close = $this->func("Portfolio")->close($port_bal);
            if ($close <> "") {
               exit();
            }
         }
      }
   }

   function ip()
   {
      echo "<pre>";
      print_r($_SERVER);
      echo "</pre>";
   }

   function check_balance()
   {
      $sign = md5("0812680983007315d7d7ef185edfbl");
      $url = 'https://prepaid.iak.id/api/check-balance';
      $data = [
         "username" => "081268098300",
         "sign" => $sign,
      ];

      $postdata = json_encode($data);

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      $result = curl_exec($ch);
      curl_close($ch);

      $response = json_decode($result, JSON_PRESERVE_ZERO_FRACTION);
      print_r($response);
   }

   function wow_white()
   {
      $cek = $this->model("Wowpay")->ipWhite();
      echo "<pre>";
      print_r($cek);
      echo "</pre>";
   }

   function wow_order()
   {
      $refID = "D92834";
      $amount = 10000;
      $custName = "Joko Sopo";
      $hp = "08523521254";
      $email = "Joko@gmail.com";

      $order = $this->model("Wowpay")->order($refID, $amount, $custName, $hp, $email);
      echo "<pre>";
      print_r($order);
      echo "</pre>";
   }

   function settle()
   {
      $data = $this->db(0)->get_where("portfolio", "port_status = 1");
      foreach ($data as $d) {
         $up = $this->db(0)->update("daily_checkin", "settle = 1", "ref = '" . $d['port_id'] . "'");
         $up2 = $this->db(0)->update("daily_watch", "settle = 1", "ref = '" . $d['port_id'] . "'");
         echo "<pre>";
         print_r($up);
         echo "<br>";
         print_r($up2);
         echo "<br>";
         echo "</pre>";
      }

      echo "<hr>";

      $data = $this->db(0)->get_where("portfolio", "port_status = 0");
      foreach ($data as $d) {
         $fee_dc = 0;
         $fee_dc = $this->db(0)->get_cols_where("daily_checkin", "SUM(fee) as amount", "settle = 0 AND ref = '" . $d['port_id'] . "'", 0)['amount'];

         $fee_dw = 0;
         $fee_dw = $this->db(0)->get_cols_where("daily_watch", "SUM(fee) as amount", "settle = 0 AND ref = '" . $d['port_id'] . "'", 0)['amount'];

         if ($fee_dc <> 0) {
            $cols = "flow, balance_type, user_id, ref, amount, tr_status, insertTime";
            $vals = "1,50,'" . $d['user_id'] . "','" . $d['port_id'] . "'," . $fee_dc . ",1,'" . $GLOBALS['now'] . "'";
            $in = $this->db(0)->insertCols("balance", $cols, $vals);
            if ($in['errno'] == 0) {
               $up_dc = $this->db(0)->update("daily_checkin", "settle = 1", "ref = '" . $d['port_id'] . "'");
               echo "<pre>";
               print_r($up_dc);
               echo "<pre>";
            }
         }

         if ($fee_dw <> 0) {
            $cols = "flow, balance_type, user_id, ref, amount, tr_status, insertTime";
            $vals = "1,51,'" . $d['user_id'] . "','" . $d['port_id'] . "'," . $fee_dw . ",1,'" . $GLOBALS['now'] . "'";
            $in = $this->db(0)->insertCols("balance", $cols, $vals);
            if ($in['errno'] == 0) {
               $up_dw = $this->db(0)->update("daily_watch", "settle = 1", "ref = '" . $d['port_id'] . "'");
               echo "<pre>";
               print_r($up_dw);
               echo "<pre>";
            }
         }
      }
   }

   function create()
   {


      $data = [
         [
            "no" => "081268098300",
            "nama" => "Rangga_2",
            "access" => [0, 10, 20]
         ],
         [
            "no" => "089693451283",
            "nama" => "Rangga",
            "access" => [0, 10, 20]
         ],
         [
            "no" => "081388866999",
            "nama" => "Sultan Gedago",
            "access" => [0, 10, 20]
         ],
         [
            "no" => "087877077933",
            "nama" => "Annisa AzZahrah",
            "access" => [10, 20]
         ],
         [
            "no" => "085150971008",
            "nama" => "Sultan Gedago",
            "access" => [10, 20]
         ],
      ];

      $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
      file_put_contents('app/config/JSON/user_admin.json', $jsonfile);
   }

   function sess_clear()
   {
      session_destroy();
   }

   function cek_sess()
   {
      echo "<pre>";
      print_r($_SESSION);
      echo "</pre>";
   }

   function cek_zone()
   {
      date_default_timezone_set("Asia/Jakarta");
      echo date("Y-m-d H:i:s");
      echo "<br>";
   }
}
