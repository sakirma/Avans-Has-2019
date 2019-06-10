<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('nl_NL');

        for ($i = 1; $i <= 10; $i++) {
            DB::table('route')->insert([
                'name' => $faker->streetName,
                'length' => rand(0, 100),
                'amount_clicks' => rand(0, 50)
            ]);
        }
    }
}
