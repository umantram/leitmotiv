<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ActorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            DB::table('actor')->insert([
                'nombre' => $faker->name,
                'fechanacimiento' => $faker->date(),
                'director' => $faker->numerify("#"),
            ]);
        }
    }
}
