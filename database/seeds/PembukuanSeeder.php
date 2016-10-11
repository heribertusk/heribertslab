<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PembukuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      foreach (range(1, 30) as $index) {
        DB::table('projects')->insert([
          'name' => $faker->company,
          'created_at' => $faker->dateTime($max = 'now'),
          'updated_at' => $faker->dateTime($max = 'now'),
        ]);
      }

      foreach (range(1, 50) as $index) {
        DB::table('activities')->insert([
          'project_id' => $faker->numberBetween(1, 30),
          'name' => $faker->catchPhrase,
          'created_at' => $faker->dateTime($max = 'now'),
          'updated_at' => $faker->dateTime($max = 'now'),
        ]);
      }

      DB::table('account_codes')->insert([
        ['kode' => '100.000.000', 'name'=>'AKTIVA'],
        ['kode' => '110.000.000', 'name'=>'KAS & SETARA KAS'],
        ['kode' => '112.000.000', 'name'=>'BANK'],
        ['kode' => '111.200.000', 'name'=>'Kas Project'],
        ['kode' => '310.000.000', 'name'=>'Aktiva Bersih Tidak Terikat'],
      ]);
    }
}
