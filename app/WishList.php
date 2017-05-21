<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Auth;

class WishList extends Model
{
	protected $table = 'wish-list';
	protected $fillable = ['car_id', 'user_id'];

	public static function addToWishList($data)
	{ //dd($data);
		WishList::create(['car_id' => $data['car_id'], 'user_id' => $data['user_id'] ]);
		return true;
	}

	public static function userHasCarInWashList($data)
	{ //dd($data);
		$res = WishList::where('car_id', '=', $data['car_id'])
			       ->where('user_id', '=', $data['user_id'])
		          ->get();

		//dd($res);
		return $res;
	}
}
