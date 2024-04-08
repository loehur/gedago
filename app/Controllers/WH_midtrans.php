<?php

class WH_midtrans extends Controller
{
   private $target_notif = null;

   public function __construct()
   {
      $this->target_notif = PC::NOTIF[PC::SETTING['production']];
   }

   function notification()
   {
      header('Content-Type: application/json; charset=utf-8');

      $json = file_get_contents('php://input');
      $data = json_decode($json, true);
      $res = [];
      if (isset($data['transaction_status'])) {

         $order_ref = $data['order_id'];
         $status = $data['transaction_status'];
         $tr_time = $data['transaction_time'];
         $tr_id = $data['transaction_id'];
         $fraud_status = $data['fraud_status'];
         $expiry_time = $data['expiry_time'];

         $this->model('Log')->write("Order Ref: " . $order_ref . " New Status" . $status);

         switch ($status) {
            case 'settlement':
               $os = 1; // paid
               break;
            case 'deny';
            case 'cancel';
            case 'refund';
            case 'partial_refund';
            case 'expire';
            case 'failure';
               $os = 2; // cancel
               break;
            default:
               $os = 0; //pending
               break;
         }

         $where = "ref = '" . $order_ref . "'";
         $set = "tr_status = " . $os . ", transaction_id = '" . $tr_id . "', transaction_status = '" . $status . "', transaction_time = '" . $tr_time . "', fraud_status = '" . $fraud_status . "', expiry_time = '" . $expiry_time . "'";
         $up = $this->db(0)->update("balance", $set, $where);

         if ($up['errno'] <> 0) {
            $text = "ERROR PAYMENT. update DB when trigger New Status, Order Ref: " . $order_ref . ", New Status: " . $status . " " . $up['error'];
            $this->model('Log')->write($text);
         }

         $res = [
            "status" => "ok",
            "message" => "status updated"
         ];
      } else {
         $res = [
            "status" => "failed",
            "message" => "unknown [status]"
         ];
      }

      print_r(json_encode($res));
   }
}
