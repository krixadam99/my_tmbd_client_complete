<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('movie_tmdb_id');
            $table->timestamps();

            $table->string("title")->unique();
            $table->integer("length"); // Film length in minutes
            $table->date("release_date");
            $table->text("overview")->nullable();
            $table->string("poster_url"); //
            $table->float("tmdb_vote_avarage");
            $table->integer("tmdb_vote_count");
            $table->string("tmdb_url");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
