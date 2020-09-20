<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';

    public function pokemons()
    {
        return $this->hasMany('App\Models\Pokemon');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }



}
