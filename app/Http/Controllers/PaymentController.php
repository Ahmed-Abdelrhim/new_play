<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\PaymentPlatform;
use App\services\FatoorahService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $gateway;
    public function __construct(FatoorahService $paymentGateway)
    {
        $this->gateway = $paymentGateway;
    }


    public function showPaymentForm()
    {
        $currencies = Currency::get();
        $paymentPlatforms = PaymentPlatform::get();
        return view('payment.pay')->with(['currencies' => $currencies, 'plats' => $paymentPlatforms]);
    }

    public function pay()
    {
        $data = [
            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => '500',
            'CustomerName'       => 'Ahmed Abdelrhim',
            //'CustomerEmail'      => 'email@example.com',
            'CallBackUrl'        => env('success_url'),
            'ErrorUrl'           => env('error_url'), //or 'https://example.com/error.php'
            'DisplayCurrencyIso' => 'EGP',
            'Language'           => 'ar', //or 'en'
        ];
        $this->gateway->sendPayment($data);
    }
}

//Fill optional data
//'MobileCountryCode'  => '+965',
//'CustomerMobile'     => '1234567890',

//'CustomerReference'  => 'orderId',
//'CustomerCivilId'    => 'CivilId',
//'UserDefinedField'   => 'This could be string, number, or array',
//'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
//'SourceInfo'         => 'Pure PHP', //For example: (Symfony, CodeIgniter, Zend Framework, Yii, CakePHP, etc)
//'CustomerAddress'    => $customerAddress,
//'InvoiceItems'       => $invoiceItems,
