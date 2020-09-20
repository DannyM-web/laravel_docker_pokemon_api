<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;
    protected $table = 'abilities';

    public function pokemons()
    {
        return $this->belongsToMany('App\Models\Pokemon')->withPivot('ability_id');
    }
}
