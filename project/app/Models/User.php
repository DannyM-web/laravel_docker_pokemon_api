<?php

namespace App\Models;

use ErrorException;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * 
     */
    public function teams()
    {
        return $this->hasMany('App\Models\Team');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function hasRoles($param)
    {
        if ($this->roles->contains('name', $param)) {
            return true;
        }

        return false;
    }

    public function assignRole($param)
    {
        $role = Role::where('name', $param)->get()->first();

        if (!$role) {
            throw new ErrorException($message = 'Role not found!');
        }

        $this->roles()->attach($role);
    }

    public function hasStatus($param)
    {
        if ($this->status->name === $param) {
            return true;
        }

        return false;
    }

    public function assignStatus($param)
    {

        if (!$param) {
            throw new ErrorException($message = 'Specific a parameters (Status)');
        }
        if (!Status::where('name', $param)->exists()) {
            throw new ErrorException($message = 'Invalid status. Parameters accetped: Pending,Accepted,Rejected');
        }

        $status = Status::where('name', $param)->get()->first();
        $this->status()->associate($status);
        $this->save();
    }
}
