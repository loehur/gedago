<?php

class Login extends Controller
{

   public function __construct()
   {
      $cek = $this->func("Session")->cek_admin();
      if ($cek == 1) {
         header("Location: " . PC::BASE_URL_ADMIN . "Home");
         exit();
      }
   }

   public function index()
   {
      $data = [
         'title' => "Login",
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content()
   {
      $data = [];
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }

   function login()
   {
      $number = $_POST['hp'];
      $number = preg_replace('/[^0-9]/', '', $number);
      if (substr($number, 0, 2) == "62") {
         $number = "0" . substr($number, 2);
      }

      if (isset($_COOKIE[$number])) {
         $otp = $this->model("Encrypt")->enc($_POST['otp']);
         if ($otp <> $_COOKIE[$number]) {
            echo "OTP salah";
            exit();
         }
      } else {
         echo "Silahkan minta OTP terlebih dahulu";
         exit();
      }

      foreach ($_SESSION['config']['user_admin'] as $ua) {
         if ($ua['no'] == $number) {
            $_SESSION['log_admin'] = $ua;
            echo 1;
            exit();
         }
      }

      echo "Phone number is not registered yet";
   }

   function req_otp()
   {
      $number = $_POST['hp'];
      $number = preg_replace('/[^0-9]/', '', $number);
      if (substr($number, 0, 2) == "62") {
         $number = "0" . substr($number, 2);
      }

      foreach ($_SESSION['config']['user_admin'] as $ua) {
         if ($ua['no'] == $number) {
            if (isset($_COOKIE[$number])) {
               echo "OTP sudah di kirimkan, timeout 5 menit";
            } else {
               $otp = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
               $otp_en = $this->model("Encrypt")->enc($otp);
               setcookie($number, $otp_en, time() + (300), "/");
               $this->model('WA')->send($number, $otp);
               echo "OTP berhasil dikirimkan!";
            }
            exit();
         }
      }

      echo "Phone number is not registered yet";
   }
}
