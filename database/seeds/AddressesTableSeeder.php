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
            $newAddress->country = $faker->state;
            $newAddress->city = $faker->city;
            $newAddress->address = $faker->streetAddress;
            $newAddress->cap = $faker->numberbetween(10000,99999);
            $newAddress->district = $faker->stateAbbr;

            $newAddress->save();
        }
    }
}
