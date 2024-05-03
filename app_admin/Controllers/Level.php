<?php

class Level extends Controller
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

      if ($col == "dc") {
         $_SESSION['config']['level'][$id]["benefit"][0]['fee'] = floatval($val);
      } elseif ($col == "dwf") {
         $_SESSION['config']['level'][$id]["benefit"][1]['fee'] = floatval($val);
      } elseif ($col == "dwq") {
         $_SESSION['config']['level'][$id]["benefit"][1]['qty'] = intval($val);
      } elseif ($col == "topup" || $col == "days") {
         $_SESSION['config']['level'][$id][$col] = intval($val);
      } else {
         $_SESSION['config']['level'][$id][$col] = $val;
      }

      $data = $_SESSION['config']['level'];
      $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
      file_put_contents('../app/config/JSON/level.json', $jsonfile);
   }
}
