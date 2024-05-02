<?php

class Midtrans extends PC
{
    private $merchant_id = "G508678094";
    private $key_client = "SB-Mid-client-yGhmZSPkw-EDcVl4";
    private $key_server = "SB-Mid-server-ZHst9ED0Coy3bXI47MtueQQD";
    private $host = "https://app.sandbox.midtrans.com/snap/v1/transactions";

    public function __construct()
    {
        $this->merchant_id = $_SESSION['config']['api_key']['midtrans'][PC::APP_MODE]['merchant_id'];
        $this->key_client = $_SESSION['config']['api_key']['midtrans'][PC::APP_MODE]['key_client'];
        $this->key_server = $_SESSION['config']['api_key']['midtrans'][PC::APP_MODE]['key_server'];
        $this->host = $_SESSION['config']['api_key']['midtrans'][PC::APP_MODE]['host'];
    }

    function token($id, $amount, $name, $email, $hp)
    {
        $curl = curl_init();
        $name_ = explode(" ", $name);
        $fname = $name_[0];
        $lname = "";
        $c = count($name_);
        if ($c > 1) {
            foreach ($name_ as $key => $n) {
                if ($key <> 0) {
                    if ($key == ($c - 1)) {
                        if ($c == 2) {
                            $lname = $n;
                        } else {
                            $lname .= $n;
                        }
                    } else {
                        $lname .= $n . " ";
                    }
                }
            }
        }

        $params = [
            "transaction_details" => [
                "order_id" => $id,
                "gross_amount" => $amount
            ],
            "credit_card" => [
                "secure" => true
            ],
            "customer_details" => [
                "first_name" => $fname,
                "last_name" => $lname,
                "email" => $email,
                "phone" => $hp
            ]
        ];

        $reques_body = json_encode($params);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->host,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $reques_body,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Authorization: Basic ' . base64_encode($this->key_server . ":"),
                'Content-Type: application/json'
            ]
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response, true);
        return $res;
    }
}
