<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
		if(!$res = Conversation::where('user_id_1', auth()->id())->orWhere('user_id_2', auth()->id())->latest()->get())
			return ['ok'=>0, 'message'=>'Error while loading conversations!'];
		//dd($res);
		$users = [];
		foreach ($res as $key => $conv) { //dd($conv->user_id_1);
			if($conv->user_id_1 != auth()->id() && $conv->user_id_2 != auth()->id() )
				continue;
			if($conv->user_id_1 != auth()->id() && $conv->user_id_2 == auth()->id() )
				$usr = $conv->user_id_1;
			elseif($conv->user_id_2 != auth()->id() && $conv->user_id_1 == auth()->id() )
				$usr = $conv->user_id_2;
			//if I was one of the two users add the other user
			if(@$usr){
				$user = Conversation::userNameByID($usr); //dd($user[0]->name);
				$users[$key] = $user[0]->name;
			}
		} //dd($users);
		//if i am not in any conversation that means i don't have conversations
		if(!$res->contains('user_id_1', auth()->id()) && !$res->contains('user_id_2', auth()->id()))
			$res = [];
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

	public function sendMessageToUser(Request $request)
	{ // dd($request->all());
		if( !isset($request->convId)){ 
			$conv = Message::getConv($request->toUser); // if I have a conv with that user then get me convId or create a new one
			$request->convId = $conv->id;
		}

		if(!Message::storeMessage($request))
			Session::flash('message', 'Error while sending message!');
		Session::flash('message', 'Message was sent successfully!');

		return back();
	}
}
