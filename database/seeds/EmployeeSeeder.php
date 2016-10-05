<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      foreach (range(1, 100) as $index) {
        DB::table('employees')->insert([
          'first_name' => $faker->firstName,
          'last_name' => $faker->firstName,
          'birth_place' => $faker->city,
          'dob' => $faker->dateTimeThisCentury->format('Y-m-d'),
          'address'=> $faker->address,
          'job'=> $faker->jobTitle,
          'email'=> $faker->safeEmail,
          'phone'=> $faker->phoneNumber,
          'description' => $faker->paragraph,
          'created_at' => $faker->dateTime($max = 'now'),
          'updated_at' => $faker->dateTime($max = 'now'),
        ]);
      }
    }
}
