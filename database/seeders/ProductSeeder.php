<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Faker\Factory as Faker;
class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ru_RU');

        $categoryIds = Category::pluck('id')->toArray();

        if (empty($categoryIds)) {
            $this->command->warn('Нет категорий.');
            return;
        }

        for ($i = 0; $i < 99; $i++) {
            Product::create([
                'name' => $faker->word(),
                'description' => $faker->paragraph(3),
                'price' => $faker->randomFloat(0, 100, 50000),
                'category_id' => $faker->randomElement($categoryIds),
            ]);
        }

    }
}
