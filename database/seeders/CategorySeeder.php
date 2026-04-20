<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CategorySeeder extends Seeder
{
    public function run(): void
    {

        $faker = Faker::create('ru_RU');

        $categoryNames = [
            'Электроника',
            'Одежда и обувь',
            'Дом и сад',
            'Детские товары',
            'Красота и здоровье',
            'Спорт и отдых',
            'Автотовары',
            'Книги',
            'Продукты питания',
            'Зоотовары'
        ];


        foreach (range(1, 10) as $index) {
            $name = $categoryNames[$index - 1] ?? $faker->unique()->word;
            Category::create([
                'name' => $name,
                'description' => $faker->sentence(6), // Случайное предложение из 6 слов
            ]);
        }
    }
}
