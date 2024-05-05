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

      function compressImage($source, $destination, $quality)
      {
         $imgInfo = getimagesize($source);
         $mime = $imgInfo['mime'];
         switch ($mime) {
            case 'image/jpeg':
               $image = imagecreatefromjpeg($source);
               break;
            case 'image/png':
               $image = imagecreatefrompng($source);
               break;
            case 'image/gif':
               $image = imagecreatefromgif($source);
               break;
            default:
               $image = imagecreatefromjpeg($source);
         }

         imagejpeg($image, $destination, $quality);
         return $destination;
      }

      if (isset($_FILES['ktp']) && isset($_FILES['selfi_ktp'])) {
         $allowExt   = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');

         $uploads_dir = "files/user_identity/" . date("Y-m-d");
         //BUAT FOLDER KALAU BELUM ADA
         if (!file_exists($uploads_dir)) {
            mkdir($uploads_dir, 0777, TRUE);
         }

         $file_ = $_FILES['ktp'];
         $file2_ = $_FILES['selfi_ktp'];

         $imageTemp = $file_['tmp_name'];
         $imageTemp2 = $file2_['tmp_name'];

         $file_name = basename($file_['name']);
         $file_name2 = basename($file2_['name']);

         $imageUploadPath =  $uploads_dir . '/' . $nik . "_" . $file_name;
         $imageUploadPath2 =  $uploads_dir . '/' . $nik . "_" . $file_name2;

         $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
         $fileType2 = pathinfo($imageUploadPath2, PATHINFO_EXTENSION);

         $fileSize   = $file_['size'];
         $fileSize2   = $file2_['size'];

         if (in_array($fileType, $allowExt) === true && in_array($fileType2, $allowExt) === true) {
            if ($fileSize < 10000000) {
               if ($fileSize > 1000000) {
                  compressImage($imageTemp, $imageUploadPath, 20);
               } else {
                  move_uploaded_file($imageTemp, $imageUploadPath);
               }
            } else {
               echo "Foto KTP maksimal 10MB";
               exit();
            }
            if ($fileSize2 < 10000000) {
               if ($fileSize2 > 1000000) {
                  compressImage($imageTemp2, $imageUploadPath2, 20);
               } else {
                  move_uploaded_file($imageTemp2, $imageUploadPath2);
               }
            } else {
               echo "Foto Selfi KTP maksimal 10MB";
               exit();
            }
         } else {
            echo "Tipe gambar yang di perbolehkan (.png .jpg .jpeg)";
            exit();
         }
      }

      $cust_id = date("Ymdhis") . rand(0, 9);
      $cols = "user_id, nama, hp, nik, tgl_lahir, pw, up, img_ktp, img_selfi, email, registered";
      $vals = "'" . $cust_id . "', '" . $nama . "', '" . $number . "','" . $nik . "','" . $tgl_lahir . "','" . $pass . "','" . $rc . "','" . $imageUploadPath . "','" .  $imageUploadPath2 . "','" . $mail . "', '" . $GLOBALS['now'] . "'";
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
