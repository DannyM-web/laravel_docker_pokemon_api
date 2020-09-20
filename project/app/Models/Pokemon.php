<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;
    protected $table = 'pokemons';

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    public function abilities()
    {
        return $this->belongsToMany('App\Models\Ability');
    }

    public function types()
    {
        return $this->belongsToMany('App\Models\Type');
    }


}
