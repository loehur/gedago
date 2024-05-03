<?php

class History extends Controller
{

   public function __construct()
   {
      $cek = $this->func("Session")->cek();
      if ($cek == 0) {
         header("Location: " . PC::BASE_URL_ADMIN . "Login");
         exit();
      }
   }

   public function index()
   {
      $data = [
         'title' => "Wallet, " . __CLASS__,
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content()
   {
      $log = $_SESSION['log'];
      $data = $this->db(0)->get_where("balance", "user_id = '" . $log['user_id'] . "' AND tr_status = 1 ORDER BY insertTime DESC LIMIT 6");
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function confirm($id, $val)
   {
      $where = "flow = 1 AND balance_type = 1 AND tr_status = 0 AND balance_id = " . $id;
      $set = "tr_status = " . $val;
      $up = $this->db(0)->update("balance", $set, $where);
      if ($up['errno'] <> 0) {
         $this->model('Log')->write($up['error']);
      } else {
         echo 0;
      }
   }
}
