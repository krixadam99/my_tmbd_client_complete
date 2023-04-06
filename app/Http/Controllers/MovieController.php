<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Director;
use App\Models\Genre;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $top_rated_movies = Movie::all();
        $movies = [];
        foreach($top_rated_movies as $top_rated_movie){
            $movies []= array(
                "movie" => $top_rated_movie,
                "genres" => $top_rated_movie->genres,
                "directors" => $top_rated_movie->directors,
            );
        }

        return view('movies', ['movies' => $movies]);
    }
}
