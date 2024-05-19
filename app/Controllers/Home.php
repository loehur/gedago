<?php

class Home extends Controller
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
      $data['card'] = [
         [
            "title" => "Store",
            'm1' => "All Doors are Closed",
            'm1_v' => "Locked",
            'm2' => "Secured",
            "icon" => '<i class="bi bi-shop-window"></i>',
            "icon2" => '<i class="bi bi-cart2"></i>'
         ],
         [
            "title" => "Portfolio",
            'm1' => "Stable Network",
            'm1_v' => "Active",
            'm2' => "Connected",
            "icon" => '<i class="bi bi-journal-text"></i>',
            "icon2" => '<i class="bi bi-file-earmark-bar-graph"></i>'
         ],
         [
            "title" => "Deposit",
            'm1' => "All Lamps are Activated",
            'm1_v' => "Turn On",
            'm2' => "Activated",
            "icon" => '<i class="bi bi-bank2"></i>',
            "icon2" => '<i class="bi bi-wallet2"></i>'
         ],
         [
            "title" => "Withdraw",
            'm1' => "All Doors are Closed",
            'm1_v' => "Locked",
            'm2' => "Secured",
            "icon" => '<i class="bi bi-cash-stack"></i>',
            "icon2" => '<i class="bi bi-cash-coin"></i>'
         ],
         [
            "title" => "Members",
            'm1' => "Stable Network",
            'm1_v' => "Active",
            'm2' => "Connected",
            "icon" => '<i class="bi bi-people"></i>',
            "icon2" => '<i class="bi bi-people-fill"></i>'
         ],
      ];

      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }
}
