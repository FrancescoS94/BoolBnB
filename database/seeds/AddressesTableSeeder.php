<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Address;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++) {
            $newAddress = new Address;
            $newAddress->address = $faker->address;
            $newAddress->lat = $faker->latitude;
            $newAddress->lng = $faker->longitude;

            $newAddress->save();

        }
    }
}
