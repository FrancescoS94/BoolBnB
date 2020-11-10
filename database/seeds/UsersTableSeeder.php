<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++) {
            $newUser = new User();
            $newUser->email = $faker->email;
            $newUser->password = Hash::make('password');
            $newUser->name = $faker->firstname;
            $newUser->lastname = $faker->lastname;
            $newUser->avatar = $faker->imageUrl(640, 480);
            $newUser->date_of_birth = $faker->date();
            $newUser->status = $faker->numberBetween(0, 1);

            $newUser->save();
        }
    }
}
