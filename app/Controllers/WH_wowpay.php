<?php

class WH_wowpay extends Controller
{
   private $target_notif = null;

   private $XSECRET = "C63SPKFI5TJ7ZT74VZV4TVCDTW4HAQLZ";
   private $XSN = "WMXa4n";
   private $host = "https://dev.wowpayidr.com/";

   public function __construct()
   {
      $this->target_notif = $_SESSION['config']['notif'][PC::APP_MODE];
      $this->XSECRET = $_SESSION['config']['api_key']['wowpay'][PC::APP_MODE]['XSECRET'];
      $this->XSN = $_SESSION['config']['api_key']['wowpay'][PC::APP_MODE]['XSN'];
   }

   function notification()
   {
      $json = file_get_contents('php://input');
      $xsign = base64_encode(hash_hmac('sha256', $json, $this->XSECRET, true));

      header('Content-Type: application/json; charset=utf-8');
      header('X-SN: ' . $this->XSN);
      header('X-SIGN: ' . $xsign);

      $data = json_decode($json, true);
      $status = "UNDEFINED";
      $order_ref = "UNDEFINED";

      $res = [];
      if (isset($data['referenceId'])) {
         $orders = $data['orders'][0];
         $order_ref = $data['referenceId'];
         $status = $orders['status'];
         $tr_id = $orders['id'];
         $serviceFee = $orders['serviceFee'];

         $this->model('Log')->write("Order Ref: " . $order_ref . " New Status" . $status);

         switch ($status) {
            case 'SUCCEED':
               $os = 1; // paid
               break;
            case 'FAILED':
            case 'ERROR':
               $os = 2; // cancel
               break;
            default:
               $os = 0; //pending
               break;
         }

         $where = "ref = '" . $order_ref . "'";
         $set = "tr_status = " . $os . ", transaction_id = '" . $tr_id . "', transaction_status = '" . $status . "', fee = " . $serviceFee;
         $up = $this->db(0)->update("balance", $set, $where);

         if ($up['errno'] == 0) {
            $res = ["success" => true];
         } else {
            $text = "id -> " . $order_ref . ", status -> " . $status;
            $res = ["success" => false, "message" => $text];
            $this->model('Log')->write($text);
         }
      } else {
         $text = "id -> " . $order_ref . ", status -> " . $status;
         $res = ["success" => false, "message" => $text];
         $this->model('Log')->write($text);
      }

      print_r(json_encode($res));
   }

   function notificationPay()
   {
      $json = file_get_contents('php://input');
      $xsign = base64_encode(hash_hmac('sha256', $json, $this->XSECRET, true));

      header('Content-Type: application/json; charset=utf-8');
      header('X-SN: ' . $this->XSN);
      header('X-SIGN: ' . $xsign);

      $data = json_decode($json, true);
      $status = "UNDEFINED";
      $order_ref = "UNDEFINED";

      $res = [];
      if (isset($data['referenceId'])) {
         $order_ref = $data['referenceId'];
         $tr_id = $data['id'];
         $status = $data['status'];
         $serviceFee = $data['serviceFee'];

         $this->model('Log')->write("Order Ref: " . $order_ref . " New Status" . $status);

         switch ($status) {
            case 'SUCCEED':
               $os = 1; // paid
               break;
            case 'FAILED':
            case 'ERROR':
               $os = 2; // cancel
               break;
            default:
               $os = 0; //pending
               break;
         }

         $where = "balance_id = '" . $order_ref . "'";
         $set = "tr_status = " . $os . ", transaction_id = '" . $tr_id . "', transaction_status = '" . $status . "', fee = " . $serviceFee;
         $up = $this->db(0)->update("balance", $set, $where);

         if ($up['errno'] == 0) {
            $res = ["success" => true];
         } else {
            $text = "id -> " . $order_ref . ", status -> " . $status;
            $res = ["success" => false, "message" => $text];
            $this->model('Log')->write($text);
         }
      } else {
         $text = "id -> " . $order_ref . ", status -> " . $status;
         $res = ["success" => false, "message" => $text];
         $this->model('Log')->write($text);
      }

      print_r(json_encode($res));
   }
}
