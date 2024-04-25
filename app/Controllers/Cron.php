<?php

class Cron extends Controller
{
   function port_expired()
   {
      $data = $this->db(0)->get_where("portfolio", "port_status = 0");
      foreach ($data as $d) {
         $port_id = $d['port_id'];
         $user_id = $d['user_id'];
         $expired_date = $d['expired_date'];
         $expired = $this->func("Portfolio")->cek_expired($expired_date);

         if ($expired == 0) {
            $up = $this->db(0)->update("portfolio", "port_status = 1", "port_id = '" . $port_id . "'");
            if ($up['errno'] == 0) {
               $fee = $this->func("Portfolio")->porto_fee($user_id, $port_id);
               if ($fee > 0) {
                  $cols = "flow, balance_type, user_id, ref, amount";
                  $vals = "1,10,'" . $user_id . "','" . $port_id . "'," . $fee;
                  $in = $this->db(0)->insertCols("balance", $cols, $vals);
                  if ($in['errno'] <> 0) {
                     $up = $this->db(0)->update("portfolio", "port_status = 0", "user_id = '" . $user_id . "' AND port_id = '" . $port_id . "'");
                     $this->model('Log')->write("CRON Error " . $up['error']);
                  }
               }
            } else {
               $this->model('Log')->write("CRON error, " . $up['error']);
            }
         }
      }
   }

   function tes()
   {
      $this->model('WA')->send("081268098300", "cron tes");
   }
}
