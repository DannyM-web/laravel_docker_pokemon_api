<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pending extends Model
{
    use HasFactory;
    protected $table = 'pendings';
    protected $fillable = [
        'name', 'email', 'user_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }
}
