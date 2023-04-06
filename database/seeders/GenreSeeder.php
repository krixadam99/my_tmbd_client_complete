<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Change this to your own token!
        $genres = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/genre/movie/list'
        )->json()['genres'];

        foreach($genres as $genre){
            Genre::factory()->create([
                "genre_name" => $genre['name'],
                "genre_tmdb_id" => $genre['id'],
            ]);
        }

        //Genre::factory(15)->create();

    }
}
