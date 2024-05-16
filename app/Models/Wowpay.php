<?php

class Wowpay extends PC
{
    private $XSECRET = "C63SPKFI5TJ7ZT74VZV4TVCDTW4HAQLZ";
    private $XSN = "WMXa4n";
    private $host = "https://dev.wowpayidr.com/";

    public function __construct()
    {
        $this->XSECRET = $_SESSION['config']['api_key']['wowpay'][PC::APP_MODE]['XSECRET'];
        $this->XSN = $_SESSION['config']['api_key']['wowpay'][PC::APP_MODE]['XSN'];
        $this->host = $_SESSION['config']['api_key']['wowpay'][PC::APP_MODE]['host'];
    }

    function order($refID, $amount, $custName, $hp, $email)
    {
        $url = $this->host . 'rest/cash-in/payment-checkout';
        $data = [
            "referenceId" => $refID,
            "amount" => $amount,
            "customerName" => $custName,
            "phoneNumber" => $hp,
            "email" => $email,
            "redirectUrl" => "https://gedagoshop.com/Deposit"
        ];

        $encodedData = json_encode($data);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'X-SECRET: ' . $this->XSECRET,
            'X-SN: ' . $this->XSN,
            'Content-Type: application/json'
        ));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $encodedData);
        $result = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($result, true);
        return $res;
    }

    function ipWhite()
    {
        $curl = curl_init($this->host . "rest/");
        curl_setopt($curl, CURLOPT_URL, $this->host . "rest/");
        curl_setopt($curl, CURLOPT_HEADER, [
            'X-SECRET: ' . $this->XSECRET,
            'X-SN: ' . $this->XSN,
            'Content-Type: application/json'
        ]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response, true);
        return $res;
    }
}
