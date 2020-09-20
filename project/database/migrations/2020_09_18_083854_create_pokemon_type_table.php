<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemon_type', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pokemon_id');

            $table->foreignId('type_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->timestamps();

            $table->foreign('pokemon_id')->references('id')->on('pokemons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokemon_type');
    }
}
