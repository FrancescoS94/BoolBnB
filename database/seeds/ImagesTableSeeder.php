<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Image;
use App\Flat;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $flats = Flat::all();
        for($i = 0; $i < 10; $i++){
            $newImage = new Image();
            $newImage->image1 = $faker->imageUrl(640, 480,'city');
            $newImage->image2 = $faker->imageUrl(640, 480,'city');
            $newImage->image3 = $faker->imageUrl(640, 480,'city');
            $newImage->flat_id = $flats->unique()->random()->id;
            $newImage->save();
        }
    }
}
