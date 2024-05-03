<?php

class Admin_User extends Controller
{

   public function __construct()
   {
      $cek = $this->func("Session")->cek_admin();
      if ($cek == 0) {
         header("Location: " . PC::BASE_URL_ADMIN . "Login");
         exit();
      }

      if (in_array("uc", $_SESSION['log_admin']['privilege']) == false) {
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
      $col = $_POST['col'];

      $_SESSION['config']['user_admin'][$id][$col] = $val;
      $data = $_SESSION['config']['user_admin'];

      $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
      file_put_contents('../app/config/JSON/user_admin.json', $jsonfile);
   }

   function updateJSON_SEL()
   {
      $id = $_POST['id'];
      $val = $_POST['value'];

      foreach ($_SESSION['config']['access'] as $ca) {
         if ($ca['code'] == $val) {
            $_SESSION['config']['user_admin'][$id]["access"] = $ca['code'];
            $_SESSION['config']['user_admin'][$id]["privilege"] = $ca['privilege'];
         }
      }

      $data = $_SESSION['config']['user_admin'];

      $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
      file_put_contents('../app/config/JSON/user_admin.json', $jsonfile);
   }
}
