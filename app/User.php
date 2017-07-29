<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable/* implements BillableInterface*/
{
    use Notifiable;
    use Billable;

    protected $fillable = [
        'name', 'fname', 'lname', 'email', 'password', 'phone', 'country', 'city', 'zip',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['trial_ends_at', 'subscription_ends_at'];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function wishList()
    {
        return $this->hasMany(WishList::class);
    }
}
