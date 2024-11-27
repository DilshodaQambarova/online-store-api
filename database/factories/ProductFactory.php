<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => json_encode([
                'uz' => $this->faker->word,
                'ru' => 'Спальной мебели',
            ]),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'description' => json_encode([
                'uz' => $this->faker->paragraph(5),
                'ru' => 'Все размеры, цвета и материалы могут быть изменены по Вашему желанию!Изготовление и доставка составляет от 5 до 20 рабочих дней.Бесплатная доставка и установка.',
            ]),
            'category_id' => rand(1, 5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
