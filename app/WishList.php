<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class WishList extends Model
{
	protected $table = 'wish-list';
	protected $fillable = ['car_id', 'user_id'];

	public static function addToWishList($data)
	{
		if ( ! $wish = WishList::create(['car_id' => $data['car_id'], 'user_id' => $data['user_id'] ]) )
			return false;
		return $wish;
	}

	public static function userHasCarInWashList($data)
	{ 
		$res = WishList::where('car_id', '=', $data['car_id'])
			       ->where('user_id', '=', $data['user_id'])
		          ->get();

		return $res;
	}

	// ============ RELATIONS

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function car()
	{
		return $this->belongsTo(Car::class);
	}
}
