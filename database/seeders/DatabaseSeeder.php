<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Product;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            'Электроника',
            'Одежда',
            'Обувь',
            'Дом и кухня',
            'Красота и здоровье',
            'Спорт и отдых',
            'Детские товары',
            'Автотовары',
            'Книги',
            'Техника для дома',
        ];

        foreach ($categories as $name) {
            \App\Models\Category::firstOrCreate([
                'name' => $name
            ]);
        }

        \App\Models\Product::factory(100)->create();

    }
}
