<?php

class Login extends Controller
{

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
      $pass = $this->model("Encrypt")->enc($_POST['pw']);
      $where = "hp = '" . $_POST['hp'] . "' AND pw = '" . $pass . "'";
      $cust = $this->db(0)->get_where_row("user", $where);
      if (isset($cust['user_id'])) {
         $_SESSION['log'] = $cust;
         $_SESSION['portfolio'] = $this->func("Portfolio")->portfolio();
         echo 1;
      } else {
         echo "Login Failed!";
      }
   }

   function logout()
   {
      session_destroy();
      header("Location: " . PC::BASE_URL . "Login");
   }
}
