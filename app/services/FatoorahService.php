<?php

namespace App\services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class FatoorahService
{
    protected $base_url;
    protected $headers;
    protected $client_request;

    public function __construct(Client $client_request)
    {
        $this->client_request = $client_request;
        $this->base_url = env('FATOORAH_BASE_URL');
        $this->headers = [
            'Content-Type' => 'application/json',
            'authorization' => 'Bearer' . env('API_URL'),
        ];
    }

    public function buildRequest($uri, $method, $body = [])
    {
        $request = new Request($method, $this->base_url . $uri, $this->headers);
        if (!$body)
            return false;

        $response = $this->client_request->send($request, [
            'json' => $body,
        ]);

        if ($response->getStatusCode() != 200)
        {
            return false;
        }

        $response = json_decode($response->getBody(), true);
        return $response;
    }

    public function sendPayment($data) {
//        $requestData = $this->parsePaymentData();

        $response = $this->buildRequest('v2/SendPayment','POST',$data);
//        if($response)
//            $this->saveTransactionPayment($patient_id,$response['Data']['InvoiceId']);
//        return $response;


    }

    private function saveTransactionPayment($patient_id,$invoice_id) {

    }


    private function parsePaymentData($patient_id , $value , $planCurrency) {
        return [

        ];
    }
}
