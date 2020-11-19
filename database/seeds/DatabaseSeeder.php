<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ServicesTableSeeder::class,
            /* AddressesTableSeeder::class, */
            RatesTableSeeder::class,
            FlatsTableSeeder::class,
            MessagesTableSeeder::class,
            PaymentsTableSeeder::class,
            FlatServiceTableSeeder::class
        ]);
    }
}
