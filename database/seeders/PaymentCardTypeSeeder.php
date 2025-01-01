<?php

namespace Database\Seeders;

use App\Models\PaymentCardType;
use Illuminate\Database\Seeder;

class PaymentCardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentCardTypes = [
            [
                'name' => 'Uzum',
                'code' => 'uzum',
                'icon' => 'uzum'
            ],
            [
                'name' => 'UzCard',
                'code' => 'uzcard',
                'icon' => 'uzcard'
            ],
            [
                'name' => 'Humo',
                'code' => 'humo',
                'icon' => 'humo'
            ],
            [
                'name' => 'Visa',
                'code' => 'visa',
                'icon' => 'visa'
            ],

        ];

        PaymentCardType::insert($paymentCardTypes);
    }
}
