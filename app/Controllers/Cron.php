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
      print_r($this->db(0)->query("SET time_zone = 'Asia/Jakarta'"));
   }
}
