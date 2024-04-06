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
      $data['banner'] = 3; // File di asset, img/banner
      $data['product'] = [];
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }
}
