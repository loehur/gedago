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
      $msg = $_GET['msg'] ??  0;
      $data = [
         'title' => "Wallet, " . __CLASS__,
         'content' => __CLASS__,
         'parse' => $msg,
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content($parse)
   {
      $data['dep'] = $this->db(0)->get_where("balance", "user_id = '" . $_SESSION['log']['user_id'] . "' AND balance_type = 1 AND flow = 1 ORDER BY insertTime DESC LIMIT 1");
      $data['msg'] = $parse;
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function req_dep()
   {
      $log = $_SESSION['log'];
      $cek = $this->db(0)->count_where("balance", "user_id = '" . $log['user_id'] . "' AND flow = 1 AND balance_type = 1 AND tr_status = 0");
      if ($cek <> 0) {
         header("Location: " . PC::BASE_URL . "Deposit?msg=1");
         exit();
      }

      $pos_dep = $_POST['jumlah'];
      $amount = (int) filter_var($pos_dep, FILTER_SANITIZE_NUMBER_INT);
      if ($amount < $_SESSION['config']['setting']['min_deposit']['value']) {
         $this->model('Log')->write("Deposit Minimal " . number_format($_SESSION['config']['setting']['min_deposit']['value']));
         header("Location: " . PC::BASE_URL . "Deposit");
         exit();
      }

      $ref = "D" . date("Ymdhis") . rand(0, 9) . rand(0, 9);

      $depMode = PC::DEP_MODE;

      if ($depMode == 1) {
         $token_midtrans = $this->model("Midtrans")->token($ref, $amount, $log['nama'], $log['email'], $log['hp']);
         if (isset($token_midtrans['token'])) {
            $token = $token_midtrans['token'];
            $redirect_url = $token_midtrans['redirect_url'];

            $cols = "flow, balance_type, user_id, ref, amount, token, redirect_url, dep_mode, sender_name, insertTime";
            $vals = "1,1,'" . $log['user_id'] . "','" . $ref . "','" . $amount . "','" . $token . "','" . $redirect_url . "'," . $depMode . ",'" . $log['nama'] . "','" . $GLOBALS['now'] . "'";
            $in = $this->db(0)->insertCols("balance", $cols, $vals);

            if ($in['errno'] <> 0) {
               $this->model('Log')->write("Insert deposit Error, " . $in['error']);
               echo "Error Deposit, hubungi customer service";
               header("Location: " . PC::BASE_URL . "Home");
               exit();
            } else {
               header("Location: " . $redirect_url);
               exit();
            }
         } else {
            $this->model('Log')->write("Error get token payment midtrans");
            echo "Error Deposit, hubungi customer service";
            header("Location: " . PC::BASE_URL . "Home");
            exit();
         }
      } elseif ($depMode == 2) {
         $order = $this->model("Wowpay")->order($ref, $amount, $log['nama'], $log['hp'], $log['email']);
         if (isset($order['code']) && $order['code'] == "SUCCESS") {
            $redirect_url = $order['data']['url'];
            $cols = "flow, balance_type, user_id, ref, amount, redirect_url, dep_mode, sender_name, insertTime";
            $vals = "1,1,'" . $log['user_id'] . "','" . $ref . "','" . $amount . "','" . $redirect_url . "'," . $depMode . ",'" . $log['nama'] . "','" . $GLOBALS['now'] . "'";
            $in = $this->db(0)->insertCols("balance", $cols, $vals);

            if ($in['errno'] <> 0) {
               $this->model('Log')->write("Insert deposit Error, " . $in['error']);
               echo "Error Deposit, hubungi customer service";
               header("Location: " . PC::BASE_URL . "Home");
               exit();
            } else {
               header("Location: " . $redirect_url);
               exit();
            }
         } else {
            $this->model('Log')->write("error curl wowpay no response");
            header("Location: " . PC::BASE_URL . "Home");
            exit();
         }
      } else {
         $cols = "flow, balance_type, user_id, ref, amount, dep_mode, sender_name, insertTime";
         $vals = "1,1,'" . $log['user_id'] . "','" . $ref . "','" . $amount . "'," . $depMode . ",'" . $log['nama'] . "','" . $GLOBALS['now'] . "'";
         $in = $this->db(0)->insertCols("balance", $cols, $vals);
         header("Location: " . PC::BASE_URL . "Deposit_Confirm");
      }
   }

   function batal($id)
   {
      $log = $_SESSION['log'];
      $where = "user_id = '" . $log['user_id'] . "' AND flow = 1 AND balance_type = 1 AND tr_status = 0 AND balance_id = " . $id;
      $set = "tr_status = 2";
      $this->db(0)->update("balance", $set, $where);
      header("Location: " . PC::BASE_URL . "Deposit");
   }
}
