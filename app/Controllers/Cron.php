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

   function tes()
   {
      print_r($this->model('WA')->send(PC::NOTIF['finance'][PC::SETTING['production']], "TES"));
   }
}
