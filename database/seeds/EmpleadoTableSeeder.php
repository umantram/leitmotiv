<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmpleadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,50) as $index) {
            DB::table('empleado')->insert([
                'dni' => $faker->numberBetween(20000000, 43000000),
                'apellidonombre' => $faker->firstName(). " " . $faker->lastName(),
                'idempleadocapataz' => rand(1, 50),
                'especialidad' => $faker->jobTitle(),
            ]);
        }
    }
}
