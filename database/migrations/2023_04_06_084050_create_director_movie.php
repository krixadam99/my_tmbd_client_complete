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
        Schema::create('director_movie', function (Blueprint $table) {
            $table->timestamps();

            // Foreign key definition
            $table->unsignedBigInteger("movie_id");
            $table->foreign("movie_id")->references('id')->on('movies');

            // Foreign key definition
            $table->unsignedBigInteger("director_id");
            $table->foreign("director_id")->references('id')->on('directors');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('director_movie');
    }
};
