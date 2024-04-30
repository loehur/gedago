<?php

class Deposit extends Controller
{

   public function __construct()
   {
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
      $data = $this->db(0)->get_where("balance", "balance_type = 1 AND flow = 1 AND tr_status = 0 AND dep_mode = 0 ORDER BY insertTime DESC LIMIT 4");
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
