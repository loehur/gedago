<?php

class Members extends Controller
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
         'title' => "Account, " . __CLASS__,
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content($parse = "")
   {
      $log = $_SESSION['log'];
      $data = $this->db(0)->get_where("user", "up = '" . $log['user_id'] . "'");
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function load_video()
   {
      $data = $this->db(0)->get_where_row("video", "video_id > 0 ORDER BY RAND() LIMIT 1");
      $this->view(__CLASS__, __CLASS__ . "/video", $data);
   }
}
