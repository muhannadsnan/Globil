<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'fname', 'lname', 'email', 'password', 'phone', 'country', 'city', 'zip',
    ];

    protected $hidden = [
        'zip', 'password', 'remember_token',
    ];


    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
