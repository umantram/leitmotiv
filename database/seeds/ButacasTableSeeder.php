<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ButacasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,100) as $index) {
            DB::table('butacas')->insert([
                'numbutaca' => rand(1, 400),
                'numfila' => rand(1, 50),
            ]);
        }
    }
}
