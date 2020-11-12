<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $servizi = ['wifi', 'posto-macchina', 'piscina', 'portineria', 'sauna', 'vista-mare'];

        for($i = 0; $i < 6; $i++) {
            $newService = new Service;
            $newService->service = $servizi[$i];
            $newService->save();
        }
    }
}