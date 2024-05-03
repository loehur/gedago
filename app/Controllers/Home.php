<?php

class Home extends Controller
{
   public function __construct()
   {
   }

   public function index()
   {
      $data = [
         'title' => "Invest, " . __CLASS__,
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content($parse)
   {
      $data = [];

      if (isset($_SESSION['log'])) {
         $d = $this->db(0)->get_where_row("portfolio", "user_id = '" . $_SESSION['log']['user_id'] . "' AND port_status = 0");
         $data['port_balance'] = $this->func("Portfolio")->portfolio($d);
         if (isset($data['port_balance']['data']['user_id'])) {
            $data['checkin'] = $this->func("Portfolio")->daily_checkin_today($data['port_balance']);
            $data['watch'] = $this->func("Portfolio")->daily_watch_today($data['port_balance']);
         } else {
            $data['checkin'] = [];
            $data['watch'] = [];
            $data['fee_dc'] = [];
            $data['port_balance'] = [];
         }
      }

      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }
}
