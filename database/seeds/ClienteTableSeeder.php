<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClienteTableSeeder extends Seeder
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
            DB::table('cliente')->insert([
                'dni' => $faker->numberBetween(20000000, 43000000),
                'nombreapellido' => $faker->firstName(). " " . $faker->lastName(),
                'telefono' => rand(66666666, 99999999),
                'mail' => $faker->email(),
            ]);
        }
    }
}
