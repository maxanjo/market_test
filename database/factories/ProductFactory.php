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
        static $categories = null;

        if ($categories === null) {
            $categories = \App\Models\Category::all(); 
        }

        $category = $categories->random();
        $map = $this->productMap();

        $availableNames = $map[$category->name] ?? ['Тестовый товар', 'Универсальный продукт'];
        
        $name = $this->faker->randomElement($availableNames) . ' ' . $this->faker->numerify('##');

        return[
            'name' => $name,
            'price' => $this->faker->randomFloat(2, 500, 100000),
            'in_stock' => $this->faker->boolean(80),
            'rating' => $this->faker->randomFloat(1, 1, 5), 
            'category_id' => $category->id,
        ];
    }

    private function productMap(): array
    {
        return [
            'Электроника' => [
                'Samsung Смартфон',
                'Apple Айфон',
                'Xiaomi Телефон',
                'Sony Наушники',
            ],
            'Одежда' => [
                'Nike Футболка',
                'Adidas Худи',
                'Puma Штаны',
            ],
            'Обувь' => [
                'Nike Кроссовки',
                'Adidas Кроссовки',
            ],
            'Дом и кухня' => [
                'Миксер Bosch',
                'Чайник Philips',
                'Сковорода Tefal',
            ],
            'Красота и здоровье' => [
                'Фен Dyson',
                'Эпилятор Braun',
            ],
            'Спорт и отдых' => [
                'Гантели набор',
                'Коврик для йоги',
            ],
            'Детские товары' => [
                'Игрушка машинка',
                'Конструктор LEGO',
            ],
            'Автотовары' => [
                'Автомагнитола Sony',
                'Видеорегистратор Xiaomi',
            ],
            'Книги' => [
                'Книга PHP для начинающих',
                'Книга Laravel',
            ],
            'Техника для дома' => [
                'Пылесос Samsung',
                'Робот-пылесос Xiaomi',
            ],
        ];
    }
}
