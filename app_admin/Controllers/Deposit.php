<?php

class Deposit extends Controller
{

   public function __construct()
   {
      $cek = $this->func("Session")->cek_admin();
      if ($cek == 0) {
         header("Location: " . PC::BASE_URL_ADMIN . "Login");
         exit();
      }

      if (in_array("dp", $_SESSION['log_admin']['privilege']) == false) {
         session_destroy();
         header("Location: " . PC::BASE_URL_ADMIN . "Login");
         exit();
      }
   }

   public function index()
   {
      $data = [
         'title' => "Finance, " . __CLASS__,
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content()
   {
      $data = $this->db(0)->get_where("balance", "balance_type = 1 AND flow = 1 AND tr_status = 0 AND dep_mode = 0 ORDER BY insertTime DESC LIMIT 4");
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function confirm($id, $val)
   {
      $where = "flow = 1 AND balance_type = 1 AND tr_status = 0 AND balance_id = " . $id;
      $set = "tr_status = " . $val . ", cs = '" . $_SESSION['log_admin']['nama'] . "'";
      $up = $this->db(0)->update("balance", $set, $where);
      if ($up['errno'] <> 0) {
         $this->model('Log')->write($up['error']);
      } else {
         echo 0;
      }
   }
}
