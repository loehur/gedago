<?php

class Profil extends Controller
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

   public function content()
   {
      $this->view(__CLASS__, __CLASS__ . "/content");
   }
}
