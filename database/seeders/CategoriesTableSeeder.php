<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Овощи'],
            ['name' => 'Мясо'],
            ['name' => 'Рыба'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
