<?php

class Register extends Controller
{

   public function __construct()
   {
      $cek = $this->func("Session")->cek();
      if ($cek == 1) {
         header("Location: " . PC::BASE_URL . "Home");
         exit();
      }
   }

   public function index()
   {

      $rc = isset($_GET['rc']) ? $_GET['rc'] : '';
      $data = [
         'title' => "Register",
         'content' => __CLASS__,
         'parse' => $rc
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content($parse = 0)
   {
      $data = [];
      $data['rc'] = $parse;
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function daftar()
   {
      $number = $_POST['hp'];
      $number = preg_replace('/[^0-9]/', '', $number);
      if (substr($number, 0, 2) == "62") {
         $number = "0" . substr($number, 2);
      }

      $nama = $_POST['nama'];
      $nik = $_POST['nik'];
      $pw = $_POST['pw'];
      $repw = $_POST['repw'];
      $rc = $_POST['rc'];
      $mail = $_POST['mail'];

      $tgl_lahir = $_POST['tgl_lahir'];

      if ($pw <> $repw) {
         echo "Password tidak cocok";
         exit();
      } else {
         if (isset($_COOKIE[$number])) {
            $otp = $this->model("Encrypt")->enc($_POST['otp']);
            if ($otp == $_COOKIE[$number]) {
               $pass = $this->model("Encrypt")->enc($pw);
            } else {
               echo "OTP salah";
               exit();
            }
         } else {
            echo "Silahkan minta OTP terlebih dahulu";
            exit();
         }
      }

      $cust_id = date("Ymdhis") . rand(0, 9);
      $cols = "user_id, nama, hp, nik, tgl_lahir, pw, up, email, registered";
      $vals = "'" . $cust_id . "', '" . $nama . "', '" . $number . "','" . $nik . "','" . $tgl_lahir . "','" . $pass . "','" . $rc . "','" . $mail . "', '" . $GLOBALS['now'] . "'";
      $in = $this->db(0)->insertCols("user", $cols, $vals);
      echo $in['errno'] == 0 ? 0 : $in['error'];
   }

   function req_otp()
   {
      $number = $_POST['number'];
      $number = preg_replace('/[^0-9]/', '', $number);

      if (substr($number, 0, 2) <> "08") {
         echo "Nomor HP harus diawali 08";
         exit();
      }
      if (isset($_COOKIE[$number])) {
         echo "OTP sudah di kirimkan, timeout 5 menit";
      } else {
         $otp = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
         $otp_en = $this->model("Encrypt")->enc($otp);
         setcookie($number, $otp_en, time() + (300), "/");
         $this->model('WA')->send($number, $otp);
         echo "OTP berhasil dikirimkan!";
      }
   }
}
