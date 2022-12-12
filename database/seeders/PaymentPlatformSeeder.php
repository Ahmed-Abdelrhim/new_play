<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentPlatform;
class PaymentPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentPlatform::create([
            'name' => 'PayPal',
            'image' => 'paypal.JPG',
        ]);

        PaymentPlatform::create([
            'name' => 'Stripe',
            'image' => 'stripe.JPG',
        ]);
    }
}
// composer require league/flysystem-aws-s3-v3 "~1.0"
