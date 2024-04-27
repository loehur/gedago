<?php

class Deposit extends Controller
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
         'title' => "Deposit",
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content()
   {
      $data = $this->db(0)->get_where("balance", "user_id = '" . $_SESSION['log']['user_id'] . "' AND balance_type = 1 AND flow = 1 ORDER BY insertTime DESC LIMIT 5");
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function req_dep()
   {
      $log = $_SESSION['log'];
      $cek = $this->db(0)->count_where("balance", "user_id = '" . $log['user_id'] . "' AND flow = 1 AND balance_type = 1 AND tr_status = 0");
      if ($cek <> 0) {
         $this->model('Log')->write("Deposit sedang berlangsung");
         header("Location: " . PC::BASE_URL . "Deposit");
         exit();
      }

      $pos_dep = $_POST['jumlah'];
      $amount = (int) filter_var($pos_dep, FILTER_SANITIZE_NUMBER_INT);
      if ($amount < PC::SETTING['min_deposit']) {
         $this->model('Log')->write("Deposit Minimal " . number_format(PC::SETTING['min_deposit']));
         header("Location: " . PC::BASE_URL . "Deposit");
         exit();
      }

      $ref = date("Ymdhis") . rand(0, 9) . rand(0, 9);
      $token_midtrans = $this->model("Midtrans")->token($ref, $amount, $log['nama'], $log['email'], $log['hp']);
      if (isset($token_midtrans['token'])) {
         $token = $token_midtrans['token'];
         $redirect_url = $token_midtrans['redirect_url'];

         $cols = "flow, balance_type, user_id, ref, amount, token, redirect_url";
         $vals = "1,1,'" . $log['user_id'] . "','" . $ref . "','" . $amount . "','" . $token . "','" . $redirect_url . "'";
         $in = $this->db(0)->insertCols("balance", $cols, $vals);

         if ($in['errno'] <> 0) {
            $this->model('Log')->write("Insert deposit Error, " . $in['error']);
            echo "Error Deposit, hubungi customer service";
            header("Location: " . PC::BASE_URL . "Home");
            exit();
         } else {
            header("Location: " . $redirect_url);
         }
      } else {
         $this->model('Log')->write("Error get token payment midtrans");
         echo "Error Deposit, hubungi customer service";
         header("Location: " . PC::BASE_URL . "Home");
      }
   }

   function batal($id)
   {
      $log = $_SESSION['log'];
      $where = $this->db(0)->count_where("balance", "user_id = '" . $log['user_id'] . "' AND flow = 1 AND balance_type = 1 AND tr_status = 0 AND balance_id = " . $id);
      $set = "tr_status = 2";
      $this->db(0)->update("balance", $set, $where);
      header("Location: " . PC::BASE_URL . "Deposit");
   }
}
