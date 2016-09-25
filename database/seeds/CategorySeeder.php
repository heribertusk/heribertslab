<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert([
          ['name' => 'Fruits'],
          ['name' => 'Vegetables'],
          ['name' => 'Drinks'],
      ]);

      DB::table('sub_categories')->insert([
          ['category_id'=>1, 'name' => 'Mango'],
          ['category_id'=>1, 'name' => 'Grapes'],
          ['category_id'=>1, 'name' => 'Oranges'],
          ['category_id'=>1, 'name' => 'Strawberry'],
          ['category_id'=>1, 'name' => 'Guava'],
          ['category_id'=>1, 'name' => 'Banana'],
          ['category_id'=>1, 'name' => 'Apple'],
          ['category_id'=>1, 'name' => 'Cherry'],
          ['category_id'=>2, 'name' => 'Spinach'],
          ['category_id'=>2, 'name' => 'Broccoli'],
          ['category_id'=>2, 'name' => 'Lettuce'],
          ['category_id'=>2, 'name' => 'Leek'],
          ['category_id'=>2, 'name' => 'Cabbage'],
          ['category_id'=>3, 'name' => 'Coffe'],
          ['category_id'=>3, 'name' => 'Iced Tea'],
          ['category_id'=>3, 'name' => 'Juice'],
          ['category_id'=>3, 'name' => 'Cocktail'],
          ['category_id'=>3, 'name' => 'Wine'],
          ['category_id'=>3, 'name' => 'Milkshake'],
      ]);
    }
}
