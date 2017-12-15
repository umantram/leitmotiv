<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompaniaTableSeeder extends Seeder
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
            DB::table('compañia')->insert([
                'razonsocial' => $faker->company(),
            ]);
        }
    }
}
