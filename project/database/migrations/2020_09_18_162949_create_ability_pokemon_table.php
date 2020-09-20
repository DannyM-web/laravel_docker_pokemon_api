<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbilityPokemonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ability_pokemon', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pokemon_id');
            $table->unsignedBigInteger('ability_id');
            // $table->foreignId('ability_id')
            //       ->constrained()
            //       ->onDelete('cascade');

            $table->timestamps();
            $table->foreign('ability_id')->references('id')->on('abilities')->onDelete('cascade');
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
        Schema::dropIfExists('ability_pokemon');
    }
}
