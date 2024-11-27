<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => [
                    'uz' => 'Stul',
                    'ru' => 'Стул'
                ]
            ],
            [
                'name' => [
                    'uz' => 'Divan',
                    'ru' => 'Диван'
                ]
            ],
            [
                'name' => [
                    'uz' => 'Kreslo',
                    'ru' => 'Кресло'
                ]
            ],
            [
                'name' => [
                    'uz' => 'Stol',
                    'ru' => 'Стол'
                ]
            ],
            [
                'name' => [
                    'uz' => 'Krovat',
                    'ru' => 'Кровать'
                ]
            ],
        ];

        foreach ($data as $item) {
            Category::create($item);
        }
    }
}
