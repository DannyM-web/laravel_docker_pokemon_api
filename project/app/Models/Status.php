<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'statuses';

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function pendings()
    {
        return $this->hasMany('App\Models\Pending');
    }
}
