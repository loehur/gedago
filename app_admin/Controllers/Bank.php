<?php

class Bank extends Controller
{

   public function __construct()
   {
      $cek = $this->func("Session")->cek_admin();
      if ($cek == 0) {
         header("Location: " . PC::BASE_URL_ADMIN . "Login");
         exit();
      }

      if (in_array("no", $_SESSION['log_admin']['privilege']) == false) {
         session_destroy();
         header("Location: " . PC::BASE_URL_ADMIN . "Login");
         exit();
      }
   }

   public function index()
   {
      $data = [
         'title' => "Setting, " . __CLASS__,
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content()
   {
      $this->view(__CLASS__, __CLASS__ . "/content");
   }

   function updateJSON()
   {
      $id = $_POST['id'];
      $val = $_POST['value'];

      $_SESSION['config']['dep_rek'][$id] = $val;
      $data = $_SESSION['config']['dep_rek'];
      $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
      file_put_contents('../app/config/JSON/dep_rek.json', $jsonfile);
   }
}
