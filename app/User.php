<?php

namespace App;

use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;

class User extends Authenticatable/* implements BillableInterface*/
{
	use Notifiable;
	use Billable;

	protected $fillable = ['name', 'fname', 'lname', 'email', 'password', 
		'phone', 'country', 'city', 'zip', ];

	protected $hidden = ['password', 'remember_token',];

	protected $dates = ['trial_ends_at', 'subscription_ends_at'];

	public static function expiringDate()
	{  
		return '';
		$timestamp = @auth()->user()->asStripeCustomer()["subscriptions"]->data[0]["current_period_end"]; 
		return @\Carbon\Carbon::createFromTimeStamp($timestamp)->toFormattedDateString();	
	}

	public static function daysRemaining()
	{
		$created = new Carbon(@User::expiringDate());  
		$now = Carbon::now();
		// $now = new Carbon("2017-09-26 00:00:00.000000");
		
		return @$created->diff($now)->days < 1 ? 'today' : $created->diffInDays($now);
		// dd($created->diff($now)->days < 1 ? 'today' : $created->diffInDays($now));
	}

	public function plan()
	{
		return '';
		return @auth()->user()->subscriptions[0]->name;
	}

//=================== RELATIONSHIPS ====================
	public function cars()
	{
		return $this->hasMany(Car::class);
	}

	public function wishList()
	{
		return $this->hasMany(WishList::class);
	}

	public function subscriptions()
	{
		return '';
		return $this->hasMany(Subscription::class)->orderBy('created_at', 'desc');
	}

	public function saved_searches()
	{
		return $this->hasMany(SavedSearch::class)->orderBy('created_at', 'desc');
	}
}
