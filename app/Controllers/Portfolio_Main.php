<?php

class Portfolio_Main extends Controller
{
   public function __construct()
   {
      $cek = $this->func("Log")->cek();
      if ($cek == 0) {
         header("Location: " . PC::BASE_URL . "Login");
         exit();
      }
   }

   public function index()
   {
      $data = [
         'title' => __CLASS__,
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content($parse = "")
   {
      $log = $_SESSION['log'];

      $data['port_balance'] = $this->func("Portfolio")->portfolio();
      if (isset($data['port_balance']['data']['user_id'])) {
         $data['checkin'] = $this->func("Portfolio")->daily_checkin($data['port_balance']);
         $data['watch'] = $this->func("Portfolio")->daily_watch($data['port_balance']);
         if (isset($data['port_balance']['data']['port_id'])) {
            $data['fee_dc'] = $this->func("Portfolio")->daily_fee($data['port_balance']['data']['port_id']);
         } else {
            $data['fee_dc'] = [];
         }
         $data['porto'] = $this->db(0)->get_where("portfolio", "user_id = '" . $log['user_id'] . "' ORDER BY port_id DESC");
      } else {
         $data['porto'] = [];
         $data['checkin'] = [];
         $data['watch'] = [];
         $data['fee_dc'] = [];
      }

      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function load_video()
   {
      $data = $this->db(0)->get_where_row("video", "video_id > 0 ORDER BY RAND() LIMIT 1");
      $this->view(__CLASS__, __CLASS__ . "/video", $data);
   }
}
