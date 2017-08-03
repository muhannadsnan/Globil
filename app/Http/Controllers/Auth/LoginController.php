<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Stripe\Stripe;

class LoginController extends Controller
{

	 use AuthenticatesUsers;

	 protected $redirectTo = '/home';

	 public function __construct()
	 {
		  $this->middleware('auth')->except(['showLoginForm', 'login']);
	 }

	 public function profile()
	 {
		  if(auth()->user()->type == "A")
				return back();
		  $isMarkNotifAsRead = true;
		  return view('auth.profile', compact('isMarkNotifAsRead'));
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


// ======== PAYMENT ========
	  public function getpayment($plan)
	  {
			$plans = ['gold' => 999, 'daily' => 86];
			$myPlan['name'] = $plan;
			$myPlan['price'] = $plans[$plan]; //dd($myPlan);
			return view('auth.payment', compact('myPlan'));
	  }


	  public function payment(Request $request)
	  {
			// dd($request->all());
			//dd(auth()->user()->subscription('gold'));
			auth()->user()->newSubscription('gold', 'gold')->create($request->stripeToken);
			return 'DONE !';
	  }


}
