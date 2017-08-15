<?php

namespace App;

use App\Message;

// use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	public static function storeMessage($request)
	{ //dd($request->convId);
		Message::create([
				'conv_id' => $request->convId,
				'user_id' => auth()->id(),
				'text' => $request->msg,
			]);
		return true;
	}

	public static function getConv($toUser)
	{ 
		// if I have a conv with that user then get me convId
		if( $conv = Message::convExistForTwoUsers(auth()->id(), $toUser ) != false)
			return $conv;
		// else create a conv for us
		return Conversation::create([
				'user_id_1' => auth()->id(),
				'user_id_2' => $toUser
			]);
	}

	public static function convExistForTwoUsers($user1, $user2)
	{
		if(($c = Conversation::where('user_id_1', $user1)->where('user_id_2', $user2)->get())->count() > 0
		|| ($c = Conversation::where('user_id_2', $user1)->where('user_id_1', $user2)->get())->count() > 0)
			return $c;
		return false;
	}
}
