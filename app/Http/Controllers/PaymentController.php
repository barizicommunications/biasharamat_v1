<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{



    public function makePayment(){

        return view('buyer.payment');
    }




    private $consumerKey = "qkio1BGGYAXTu2JOfm7XSXNruoZsrqEW";
    private $consumerSecret = "osGQ364R49cXKeOYSpaOnT++rHs=";
    private $token = null;

    public function generateAccessToken()
    {
        $apiUrl = "https://cybqa.pesapal.com/pesapalv3/api/Auth/RequestToken";

        $headers = [
            "Accept: application/json",
            "Content-Type: application/json"
        ];

        $data = [
            "consumer_key" => $this->consumerKey,
            "consumer_secret" => $this->consumerSecret
        ];

        // cURL request to get access token
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response);
        if (isset($data->token)) {
            $this->token = $data->token;
            return $this->token;
        } else {
            return null;
        }
    }

    public function registerIPN($token)
    {
        $ipnUrl = "https://a9fb-41-90-228-219.ngrok-free.app/pin.php";
        $ipnRegistrationUrl = "https://cybqa.pesapal.com/pesapalv3/api/URLSetup/RegisterIPN";

        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer $token"
        ];

        $data = [
            "url" => $ipnUrl,
            "ipn_notification_type" => "GET"
        ];

        // cURL request to register IPN
        $ch = curl_init($ipnRegistrationUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response);
        return $data->ipn_id ?? null;
    }

    public function submitOrder($token, $ipnId, $orderData)
    {
        $merchantReference = rand(1, 1000000000000000000);
        $submitOrderUrl = "https://cybqa.pesapal.com/pesapalv3/api/Transactions/SubmitOrderRequest";

        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer $token"
        ];

        $data = [
            "id" => $merchantReference,
            "currency" => "KES",
            "amount" => $orderData['amount'],
            "description" => $orderData['description'],
            "callback_url" => $orderData['callback_url'],
            "notification_id" => $ipnId,
            "branch" => $orderData['branch'],
            "billing_address" => [
                "email_address" => $orderData['email_address'],
                "phone_number" => $orderData['phone_number'],
                "country_code" => "KE",
                "first_name" => $orderData['first_name'],
                "middle_name" => $orderData['middle_name'],
                "last_name" => $orderData['last_name']
            ]
        ];

        // cURL request to submit order
        $ch = curl_init($submitOrderUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response);
        return $data->redirect_url ?? null;
    }

    public function getTransactionStatus($token, $orderTrackingId)
    {
        $getTransactionStatusUrl = "https://cybqa.pesapal.com/pesapalv3/api/Transactions/GetTransactionStatus?orderTrackingId=$orderTrackingId";

        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer $token"
        ];

        // cURL request to check transaction status
        $ch = curl_init($getTransactionStatusUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response);
        return $data->payment_status_description ?? 'Unknown';
    }
}
