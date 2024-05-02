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
         'title' => "Withdraw",
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content()
   {
      $data['wd'] = $this->db(0)->get_where("balance", "user_id = '" . $_SESSION['log']['user_id'] . "' AND balance_type = 1 AND flow = 2 ORDER BY insertTime DESC LIMIT 10");
      $data['saldo'] = $this->func("Balance")->saldo();

      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function req_dep()
   {
      $log = $_SESSION['log'];

      //cek dulu profil bank
      if ($log['no_rek'] == '') {
         echo "Atur rekening Penarikan terlebih dahulu, di menu Profil - Bank Account";
         exit();
      }

      $pos_dep = $_POST['jumlah'];
      $amount = (int) filter_var($pos_dep, FILTER_SANITIZE_NUMBER_INT);

      //cek dlu saldo
      $saldo = $this->func("Balance")->saldo();
      if ($saldo < $amount) {
         echo "Saldo tidak cukup";
         exit();
      }

      if ($amount < $_SESSION['config']['setting']['min_wd']['value']) {
         echo "Withdraw Minimal " . number_format($_SESSION['config']['setting']['min_wd']['value']);
         exit();
      }

      $cols = "flow, balance_type, user_id, amount, bank, rek_no, rek_name";
      $vals = "2,1,'" . $log['user_id'] . "'," . $amount . ",'" . $log['bank'] . "','" . $log['no_rek'] . "','" . $log['nama'] . "'";
      $in = $this->db(0)->insertCols("balance", $cols, $vals);
      if ($in['errno'] <> 0) {
         $this->model('Log')->write("Insert Withdraw Error, " . $in['error']);
         $this->model('WA')->send($_SESSION['config']['notif']['finance'][PC::APP_MODE], "WD Request Error\n" . $in['error']);
         echo "Error Withdraw, hubungi customer service";
         exit();
      } else {
         $text = "Withdraw Requested\n" . $log['nama'];
         $this->model('WA')->send($_SESSION['config']['notif']['finance'][PC::APP_MODE], $text);
         echo 0;
      }
   }
}
