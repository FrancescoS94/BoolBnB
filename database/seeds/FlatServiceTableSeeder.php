<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Flat;
use App\Service;

class FlatServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // "table" è un metodo statico di DB che seleziona la tatella "flats",
        // "pluck" è un metodo che inserisci tutti gli id della tabella flats in un array.
        $flatsIDs = DB::table('flats')->pluck('id');
        $servicesIDs= DB::table('services')->pluck('id');

        // Nel foreach il range cicla 3 volte.
        foreach (range(1, 3) as $index) {
        // Inserisce nella tabella "flat_service" le foreignkeys.
            DB::table('flat_service')->insert([
                'flat_id' => $faker->randomElement($flatsIDs),
                'service_id' => $faker->randomElement($servicesIDs)
            ]);
        }
    }
}
