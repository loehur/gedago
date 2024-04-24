<?php

class Cron extends Controller
{
   function port_expired()
   {
      $data = $this->db(0)->get_where("portfolio", "port_status = 0");
      foreach ($data as $d) {
         $port_id = $d['port_id'];
         $expired_date = $d['expired_date'];
         $expired = $this->func("Portfolio")->cek_expired($expired_date);
         if ($expired == 0) {
            $up = $this->db(0)->update("portfolio", "port_status = 1", "port_id = '" . $port_id . "'");
            if ($up['errno'] <> 0) {
               $this->model('Log')->write("CRON error, " . $up['error']);
            }
         }
      }
   }
}
