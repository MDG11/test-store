<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\CategoryFactory;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::factory()->create();
    }
}
