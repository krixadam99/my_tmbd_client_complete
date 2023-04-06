<?php

namespace Database\Seeders;

use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Change this to your own token
        $token = config('services.tmdb.token');
        $top_rated_movies = [];
        $added_directors = [];
        for($i=1; $i < 7; $i++){
            $results_per_age = Http::withToken($token)->get('https://api.themoviedb.org/3/movie/top_rated', [
                'page' => $i,
            ])->json()["results"];

            $genres = [];
            foreach($results_per_age as $movie){
                $genre_ids = $movie['genre_ids'];
                foreach($genre_ids as $genre_id){
                    $genres [] = Genre::where('genre_tmdb_id', '=', $genre_id)->first()->id;
                }

                $movie_details_and_credits = Http::withToken($token)->get('https://api.themoviedb.org/3/movie/' . $movie['id'] . '?append_to_response=credits')->json();
                $movie_crew = $movie_details_and_credits['credits']['crew'];
                $director_names = [];
                $directors_related_to_movie = [];
                foreach($movie_crew as $member){
                    if($member['known_for_department'] === 'Directing'){
                        $director_id = $member['id'];
                        $director_name = $member['name'];
                        if(!in_array($director_name, $director_names)){
                            // The execution time is incredibly extended if we want to fetch the directors' details
                            $director_details = Http::withToken($token)->get('https://api.themoviedb.org/3/person/' . $director_id)->json();
                            $director_biography = $director_details['biography'];
                            $director_birthday = $director_details['birthday'];

                            if(!in_array($director_name, $added_directors)){
                                $added_directors []= $director_name;
                                Director::factory()->create([
                                    "director_tmdb_id" => $director_id,
                                    "name" => $director_name,
                                    "biography" => $director_biography,
                                    "date_of_birth" => $director_birthday
                                ]);
                            }
                            $directors_related_to_movie []= Director::where('director_tmdb_id', '=', $director_id)->first()->id;
                            $director_names []= $director_name;
                        }
                    }
                }

                Movie::factory()->create([
                        "title" => $movie['title'],
                        "length" => $movie_details_and_credits['runtime'],
                        "release_date" => $movie['release_date'],
                        "overview" => $movie['overview'],
                        "poster_url" => $movie['poster_path'],
                        "tmdb_vote_avarage" => $movie['vote_average'],
                        "tmdb_vote_count" => $movie['vote_count'],
                        "movie_tmdb_id" => $movie['id']
                ]);
                $inserted_movie = Movie::where('movie_tmdb_id', '=', $movie['id'])->first();
                foreach($genres as $genre){
                    $inserted_movie->genres()->attach($genre);
                }
                foreach($directors_related_to_movie as $director_related_to_movie){
                    $inserted_movie->directors()->attach($director_related_to_movie);
                }
            }
        }
    }
}
