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
                'name' => json_encode([
                    'uz' => 'Stul',
                    'ru' => 'Стул'
                ])
            ],
            [
                'name' => json_encode([
                    'uz' => 'Divan',
                    'ru' => 'Диван'
                ])
            ],
            [
                'name' => json_encode([
                    'uz' => 'Kreslo',
                    'ru' => 'Кресло'
                ])
            ],
            [
                'name' => json_encode([
                    'uz' => 'Stol',
                    'ru' => 'Стол'
                ])
            ],
            [
                'name' => json_encode([
                    'uz' => 'Krovat',
                    'ru' => 'Кровать'
                ])
            ],
        ];

        foreach ($data as $item) {
            Category::create($item);
        }
    }
}
