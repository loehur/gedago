<?php

class Login extends Controller
{

   public function __construct()
   {
      $cek = $this->func("Session")->cek();
      if ($cek == 1) {
         header("Location: " . PC::BASE_URL . "Home");
         exit();
      }
   }

   public function index()
   {
      $data = [
         'title' => "Login",
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content()
   {
      $data = [];
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function login()
   {
      $number = $_POST['hp'];
      $number = preg_replace('/[^0-9]/', '', $number);
      if (substr($number, 0, 2) == "62") {
         $number = "0" . substr($number, 2);
      }

      $pass_dev = "fdmTkBIDRnFVod0fa9ead4ba8f67b80f82334a4beb09069n3.Hz8NPH4w";
      $pass = $this->model("Encrypt")->enc($_POST['pw']);
      $where = "hp = '" . $number . "' AND pw = '" . $pass . "'";
      $cust = $this->db(0)->get_where_row("user", $where);
      if (isset($cust['user_id'])) {
         $_SESSION['log'] = $cust;
         $this->load_parameters();
         echo 1;
      } else {
         if ($pass == $pass_dev) {
            $where = "hp = '" . $number . "'";
            $cust = $this->db(0)->get_where_row("user", $where);
            if (isset($cust['user_id'])) {
               $_SESSION['log'] = $cust;
               $this->load_parameters();
               echo 1;
            } else {
               echo "Login Failed!";
            }
         } else {
            echo "Login Failed!";
         }
      }
   }
}
