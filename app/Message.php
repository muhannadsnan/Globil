<?php

namespace App;

use App\Message;

// use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	// protected $
	public static function storeMessage($request)
	{ //dd($request->convId);
		Message::create([
				'conv_id' => $request->convId,
				'user_id' => auth()->id(),
				'text' => $request->msg,
			]);
		return true;
	}
}
