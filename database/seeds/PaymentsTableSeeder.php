<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\Flat;
use App\Rate;
use App\Payment;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();
        $flats = Flat::all();
        $rates = Rate::all();
        for($i = 0; $i < 10; $i++) {
            $newPayment = new Payment;
            $newPayment->user_id = $users->random()->id;
            $newPayment->flat_id = $flats->random()->id;
            $newPayment->rate_id = $rates->random()->id;

            $newPayment->save();
        }
    }
}
