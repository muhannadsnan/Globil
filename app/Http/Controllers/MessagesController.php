<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		// $convs = 
		return view('conv.index', compact('convs'));
	}


	public function getConvsWithUserInfo()
	{
		if(!$res = Conversation::latest()->get())
			return ['ok'=>0, 'message'=>'Error while loading conversations!'];
		// dd($res);
		$users = [];
		foreach ($res as $key => $conv) { //dd($conv->user_id_1);
			if($conv->user_id_1 != auth()->id())
				$usr = $conv->user_id_1;
			else
				$usr = $conv->user_id_2;

			$user = Conversation::userNameByID($usr); //dd($user[0]->name);
			$users[$key] = $user[0]->name;
		} //dd($users);
		return ['ok'=>1, 'message'=>'Conversations where loadded successfully!', 'data'=>$res, 'users'=>$users];
	}


	public function getMessagesByConvId($convId)
	{
		if(!$res = Message::where('conv_id', $convId)->take(50)->get())
			return ['ok'=>0, 'message'=>'Error while loading conversations!'];
		return ['ok'=>1, 'message'=>'Conversations where loadded successfully!', 'data'=>$res, 'user_id'=>auth()->id()];
	}

	public function store(Request $request)
	{
		if(!Message::storeMessage($request))
			return ['ok'=>0, 'message'=>'Error while sending message!'];
		return ['ok'=>1, 'message'=>'Message was sent successfully!', 'user_id'=>'none'];
	}
}
