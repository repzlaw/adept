<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use StateLgaTableSeeder;
use StateTableSeeder;

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
            StateTableSeeder::class,
            StateLgaTableSeeder::class,
        ]);
    }
}
