<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentType::create([
            'name' => [
                'uz' => 'Naqd',
                'ru' => 'Наличные',
            ],
        ]);
        PaymentType::create([
            'name' => [
                'uz' => 'Terminal',
                'ru' => 'Терминал',
            ],
        ]);
        PaymentType::create([
            'name' => [
                'uz' => 'Click',
                'ru' => 'Клик',
            ],
        ]);
        PaymentType::create([
            'name' => [
                'uz' => 'Payme',
                'ru' => 'Пайме',
            ],
        ]);
        PaymentType::create([
            'name' => [
                'uz' => 'Uzum',
                'ru' => 'Узум',
            ],
        ]);
    }
}
