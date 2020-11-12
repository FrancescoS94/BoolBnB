<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Message;
use App\Flat;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $flats = Flat::all();
        for($i = 0; $i < 10; $i++) {
            $newMessage = new Message();
            $newMessage->name = $faker->firstname;
            $newMessage->lastname = $faker->lastname;
            $newMessage->email = $faker->email;
            $newMessage->request = $faker->realText();
            $newMessage->viewed = $faker->numberBetween(0, 1);
            $newMessage->flat_id = $flats->random()->id;

            $newMessage->save();
        }
    }
}
