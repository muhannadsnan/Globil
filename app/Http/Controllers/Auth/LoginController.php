<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

	use AuthenticatesUsers;

	protected $redirectTo = '/home';

	public function __construct()
	{
		//$this->middleware('guest')->except(['logout', 'profile', 'controlPanel']);
		// $this->middleware('auth')->only(['profile', 'controlPanel']);
		$this->middleware('guest')->only(['logout']);
	}

	public function profile()
	{
		if(auth()->user()->type == "A")
			return back();
		return view('auth.profile', compact(''));
	}

	public function controlPanel()
	{
		if(auth()->user()->type == "B")
			return back();
		return view('auth.controlPanel', compact(''));
	}

	public function userTimeline(User $user)
	{
		return view('auth.user-timeline', compact('user'));
	}
}
