<?php

class Bank extends Controller
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

   function update()
   {
      $log = $_SESSION['log'];

      $set = "bank = '" . $_POST['bank'] . "', no_rek = '" . $_POST['no_rek'] . "'";
      $where = "user_id = '" . $log['user_id'] . "'";
      $up = $this->db(0)->update("user", $set, $where);
      if ($up['errno'] == 0) {
         $_SESSION['log'] = $this->db(0)->get_where_row("user", $where);
         echo 0;
      } else {
         $this->model('Log')->write($up['error']);
      }
   }

   function batal($id)
   {
      $log = $_SESSION['log'];
      $where = $this->db(0)->count_where("balance", "user_id = '" . $log['user_id'] . "' AND flow = 1 AND balance_type = 1 AND tr_status = 0 AND balance_id = " . $id);
      $set = "tr_status = 2";
      $this->db(0)->update("balance", $set, $where);
      header("Location: " . PC::BASE_URL . "Withdraw");
   }
}
