<?php

class Portfolio_Main extends Controller
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
      $data = [];
      $log = $_SESSION['log'];
      $data['checkin'] = $this->func("Portfolio")->daily_checkin();
      if (isset($_SESSION['portfolio']['port_id'])) {
         $data['fee_dc'] = $this->func("Portfolio")->daily_fee($_SESSION['portfolio']['port_id']);
      } else {
         $data['fee_dc'] = [];
      }
      $data['porto'] = $this->db(0)->get_where("portfolio", "user_id = '" . $log['user_id'] . "' ORDER BY port_id DESC");
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }
}
