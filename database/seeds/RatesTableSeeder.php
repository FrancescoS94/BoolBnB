<?php

use Illuminate\Database\Seeder;
use App\Rate;

class RatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 3; $i++) {
            $newRate = new Rate;
            if($i == 0) {
                $newRate->price = 2.99;
                $newRate->hours = 24;
            } elseif($i == 1) {
                $newRate->price = 5.99;
                $newRate->hours = 72;
            } else {
                $newRate->price = 9.99;
                $newRate->hours = 144;
            }

            $newRate->save();
        }
    }
}
