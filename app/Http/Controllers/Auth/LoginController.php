<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

	use AuthenticatesUsers;

	protected $redirectTo = '/home';

	public function __construct()
	{
		$this->middleware('guest')->except(['logout', 'profile', 'controlPanel']);
		$this->middleware('auth')->only(['profile', 'controlPanel']);
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
}
