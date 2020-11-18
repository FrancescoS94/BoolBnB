<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Flat;
use App\User;
use App\Address;

class FlatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();
        $addresses = Address::all();
        for($i = 0; $i < 10; $i++) {
            $newFlat = new Flat();
            $newFlat->title= $faker->realText(200);
            $newFlat->room  = $faker->numberBetween(1, 10);
            $newFlat->bed = $faker->numberBetween(1, 10);
            $newFlat->wc = $faker->numberBetween(1, 3);
            $newFlat->mq = $faker->numberBetween(35, 500);
            $newFlat->image = $faker->imageUrl(640, 480,'city');
            $newFlat->description = $faker->realText();

            $newFlat->user_id = $users->random()->id;
            /* $newFlat->address_id = $addresses->random()->id; */

            $newFlat->save();
        }
    }
}
