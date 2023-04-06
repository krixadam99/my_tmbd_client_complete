@extends('layouts.layout')

@section('title', 'Movies')

@section('content')
    <h1 class="ps-3">Movies with best rating</h1>
    <hr />
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="text-center table-light">
                <tr>
                    <th>Title</th>
                    <th>Length (in mins)</th>
                    <th>Genres</th>
                    <th>Release date</th>
                    <th>Overview</th>
                    <th>Poster URL</th>
                    <th>TMDB id</th>
                    <th>TMDB vote avg</th>
                    <th>TMDB vote count</th>
                    <th>TMDB url</th>
                    <th>Director(s)</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($movies as $movie)
                    <tr>
                        <td>
                            <div>{{ $movie['movie']->title }}</div>
                        </td>
                        <td>
                            <div>{{ $movie['movie']->length }}</div>
                        </td>
                        <td>
                            <table class="table align-middle table-hover">
                                <tbody class="text-center">
                                    @foreach ($movie['genres'] as $genre)
                                        <tr>
                                            <td>
                                                <div>{{ $genre->genre_name }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <div>{{ $movie['movie']->release_date }}</div>
                        </td>
                        <td>
                            <div class="elliptical_text">{{ $movie['movie']->overview }}</div>
                        </td>
                        <td>
                            <div>{{ $movie['movie']->poster_path }}</div>
                        </td>
                        <td>
                            <div>{{ $movie['movie']->movie_tmdb_id }}</div>
                        </td>
                        <td>
                            <div>{{ $movie['movie']->tmdb_vote_avarage }}</div>
                        </td>
                        <td>
                            <div>{{ $movie['movie']->tmdb_vote_count }}</div>
                        </td>
                        <td>
                            <div>
                            </div>
                        </td>
                        <td>
                            <table class="table align-middle table-hover">
                                <tbody class="text-center">
                                    @foreach ($movie['directors'] as $director)
                                        <tr>
                                            <td>
                                                <div>{{ $director->name }}</div>
                                            </td>
                                            <td>
                                                <div>{{ $director->director_tmdb_id }}</div>
                                            </td>
                                            <td>
                                                <div class="elliptical_text">{{ $director->biography }}</div>
                                            </td>
                                            <td>
                                                <div>{{ $director->date_of_birth }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
