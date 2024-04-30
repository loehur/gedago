<?php

class Withdraw_SA extends Controller
{

   public function __construct()
   {
   }

   public function index()
   {
      $data = [
         'title' => "Withdraw (SV)",
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content()
   {
      $data = $this->db(0)->get_where("balance", "balance_type = 1 AND flow = 2 AND wd_step = 1 AND tr_status = 0 ORDER BY insertTime DESC LIMIT 4");
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function confirm($id, $val)
   {
      $tr_status = 1;
      if ($val == 4) {
         $tr_status = 2;
      }

      $where = "flow = 2 AND balance_type = 1 AND tr_status = 0 AND wd_step = 1 AND balance_id = " . $id;
      $set = "tr_status = " . $tr_status . ", wd_step = " . $val . ", sv = '" . $_SESSION['log_admin']['nama'] . "'";
      $up = $this->db(0)->update("balance", $set, $where);
      if ($up['errno'] <> 0) {
         $this->model('Log')->write($up['error']);
      } else {
         echo 0;
      }
   }
}
