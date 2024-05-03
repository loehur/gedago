<?php

class Portfolio_Main extends Controller
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
         'title' => "Invest, " . __CLASS__,
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content($parse = "")
   {
      $log = $_SESSION['log'];
      $d = $this->db(0)->get_where_row("portfolio", "user_id = '" . $log['user_id'] . "' AND port_status = 0");
      $data['porto_history'] = $this->db(0)->get_where("portfolio", "user_id = '" . $log['user_id'] . "' ORDER BY port_id DESC LIMIT 3");

      $data['port_balance'] = $this->func("Portfolio")->portfolio($d);
      if (isset($data['port_balance']['data']['user_id'])) {
         $data['checkin'] = $this->func("Portfolio")->daily_checkin_today($data['port_balance']);
         $data['watch'] = $this->func("Portfolio")->daily_watch_today($data['port_balance']);
      } else {
         $data['checkin'] = [];
         $data['watch'] = [];
      }
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function load_video()
   {
      $data = $this->db(0)->get_where_row("video", "video_id > 0 ORDER BY RAND() LIMIT 1");
      $this->view(__CLASS__, __CLASS__ . "/video", $data);
   }
}
