<?php

namespace App;

use App\User;

//use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
	public function scopeUserNameByID($query, $user_id)
	{
		$res = User::where('id',$user_id)->get();
		return $res;
	}
}
