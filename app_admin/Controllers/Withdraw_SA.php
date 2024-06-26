<?php

class Withdraw_SA extends Controller
{

   public function __construct()
   {
      $cek = $this->func("Session")->cek_admin();
      if ($cek == 0) {
         header("Location: " . PC::BASE_URL_ADMIN . "Login");
         exit();
      }

      if (in_array("wd_f", $_SESSION['log_admin']['privilege']) == false) {
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
      $data[0] = $this->db(0)->get_where("balance", "balance_type = 1 AND flow = 2 AND wd_step = 1 AND tr_status = 0 ORDER BY insertTime DESC LIMIT 5");
      $data[1] = $this->db(0)->get_where("balance", "balance_type = 1 AND flow = 2 AND wd_step <> 0 AND wd_step <> 1 ORDER BY insertTime DESC LIMIT 5");
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function confirm($id, $val)
   {
      $bal = $this->db(0)->get_where_row("balance", "balance_id = '" . $id . "'");
      $where = "flow = 2 AND balance_type = 1 AND balance_id = " . $id . " AND ref = '" . $bal['ref'] . "'";
      $receiveAmount = $bal['amount'] - $bal['tr_fee'];
      if (isset($bal['ref'])) {
         if ($val == 2) {
            $pay = $this->model("Wowpay")->pay($bal['ref'], $bal['bank_code'], $bal['rek_no'], $receiveAmount, $bal['rek_name']);
            if (isset($pay['code']) && $pay['code'] == "SUCCESS") {
               $set = "transaction_status = '" . $pay['data']['status'] . "', wd_step = " . $val . ", sv = '" . $_SESSION['log_admin']['nama'] . "'";
               $up = $this->db(0)->update("balance", $set, $where);
               if ($up['errno'] <> 0) {
                  $this->model('Log')->write($up['error']);
               } else {
                  echo 0;
               }
            } else {
               $set = "tr_status = 2, transaction_status = '" . $pay['message'] . "', wd_step = " . $val . ", sv = '" . $_SESSION['log_admin']['nama'] . "'";
               $up = $this->db(0)->update("balance", $set, $where);
               if ($up['errno'] <> 0) {
                  $this->model('Log')->write($up['error']);
               } else {
                  echo 0;
               }
            }
         } else {
            $set = "tr_status = 2, wd_step = " . $val . ", sv = '" . $_SESSION['log_admin']['nama'] . "'";
            $up = $this->db(0)->update("balance", $set, $where);
            if ($up['errno'] <> 0) {
               $this->model('Log')->write($up['error']);
            } else {
               echo 0;
            }
         }
      } else {
         $this->model('Log')->write('WD Not Found');
         echo "WD Not Found";
      }
   }
}
