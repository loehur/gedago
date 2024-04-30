<?php

class Deposit_Confirm extends Controller
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
      $data['dep'] = $this->db(0)->get_where_row("balance", "user_id = '" . $_SESSION['log']['user_id'] . "' AND user_confirm = 0 AND balance_type = 1 AND flow = 1 AND tr_status = 0 ORDER BY insertTime DESC LIMIT 5");

      if (count($data['dep']) == 0) {
         header("Location: " . PC::BASE_URL . "Deposit");
      } else {
         $this->view(__CLASS__, __CLASS__ . "/content", $data);
      }
   }

   function confirm($id)
   {
      $log = $_SESSION['log'];
      $where = "user_id = '" . $log['user_id'] . "' AND flow = 1 AND balance_type = 1 AND tr_status = 0 AND balance_id = " . $id;
      $set = "user_confirm = 1, sender_name = '" . $log['nama'] . "'";
      $up = $this->db(0)->update("balance", $set, $where);

      if ($up['errno'] == 0) {
         $text = "Deposit Requested\n" . $log['nama'];
         $this->model('WA')->send(PC::NOTIF['finance'][PC::SETTING['production']], $text);
      } else {
         $this->model('WA')->send(PC::NOTIF['finance'][PC::SETTING['production']], "Deposit Request Error\n" . $up['error']);
      }

      header("Location: " . PC::BASE_URL . "Deposit");
   }
}
