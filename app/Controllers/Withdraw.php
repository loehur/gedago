<?php

class Withdraw extends Controller
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
         'title' => "Wallet, " . __CLASS__,
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content()
   {
      $data['wd'] = $this->db(0)->get_where("balance", "user_id = '" . $_SESSION['log']['user_id'] . "' AND balance_type = 1 AND flow = 2 ORDER BY insertTime DESC LIMIT 1");
      $data['saldo'] = $this->func("Balance")->saldo();

      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function req_dep()
   {
      $res = [];
      $log = $_SESSION['log'];

      //cek dulu profil bank
      if ($log['no_rek'] == '') {
         $res['msg'] = "Atur rekening Penarikan terlebih dahulu, di menu Account - Bank Account";
         $res['code'] = 0;
         print_r(json_encode($res));
         exit();
      }

      $cek = $this->db(0)->count_where("balance", "user_id = '" . $log['user_id'] . "' AND flow = 2 AND balance_type = 1 AND tr_status = 0");
      if ($cek <> 0) {
         $res['msg'] = "Sedang ada Withdraw yang masih berlangsung!";
         $res['code'] = 0;
         print_r(json_encode($res));
         exit();
      }

      $pos_dep = $_POST['jumlah'];
      $amount = (int) filter_var($pos_dep, FILTER_SANITIZE_NUMBER_INT);

      //cek dlu saldo
      $saldo = $this->func("Balance")->saldo();
      if ($saldo < $amount) {
         $res['msg'] = "Saldo tidak cukup";
         $res['code'] = 0;
         print_r(json_encode($res));
         exit();
      }

      if ($amount < $_SESSION['config']['setting']['min_wd']['value']) {
         $res['msg'] = "Withdraw Minimal " . number_format($_SESSION['config']['setting']['min_wd']['value']);
         $res['code'] = 2;
         print_r(json_encode($res));
         exit();
      }
      $ref = "W" . date("Ymdhis") . rand(0, 9) . rand(0, 9);
      $cols = "flow, balance_type, user_id, amount, bank_code, bank, rek_no, rek_name, insertTime, ref";
      $vals = "2,1,'" . $log['user_id'] . "'," . $amount . ",'" . $log['bank_code'] . "','" . $log['bank'] . "','" . $log['no_rek'] . "','" . $log['nama'] . "','" . $GLOBALS['now'] . "', '" . $ref . "'";
      $in = $this->db(0)->insertCols("balance", $cols, $vals);
      if ($in['errno'] <> 0) {
         $this->model('Log')->write("Insert Withdraw Error, " . $in['error']);
         $this->model('WA')->send($_SESSION['config']['notif']['finance'][PC::APP_MODE], "WD Request Error\n" . $in['error']);
         $res['msg'] = "Error Withdraw, hubungi customer service";
         $res['code'] = 2;
         print_r(json_encode($res));
         exit();
      } else {
         $text = "Withdraw Requested\n" . $log['nama'];
         $this->model('WA')->send($_SESSION['config']['notif']['finance'][PC::APP_MODE], $text);
         $res['msg'] = "Pengajuan Withdraw Success!";
         $res['code'] = 1;
         print_r(json_encode($res));
      }
   }
}
