<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Product');
        for($i=0; $i<11; $i++){
        DB::table('products')->insert([
            'title' => $faker->word,
            'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 200, $max = 1500),
            'in_stock' => 1,
            'description' => $faker->text($maxNbChars = 600),
        ]);
    }
}
}