<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\DirectorSeeder;
use Database\Seeders\MovieSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            //DirectorSeeder::class,
            GenreSeeder::class,
            MovieSeeder::class

        ]);
    }
}
