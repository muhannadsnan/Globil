<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class BeforeCheckCreateCar
{

    public function handle($request, Closure $next)
    {
         if(auth()->user()->daysRemaining() == 0){ 
            Session::flash('info', 'Sorry! You can not create a car because your subscription has ended! Please subscribe to one of our offers.');
            return redirect('/our-offers');
        }
        
        if(auth()->user()->plan() == 'standard' && count(auth()->user()->cars)){
            Session::flash('info', 'Sorry! You can not create a car because you have published a free car already! Please subscribe to one of our offers.');
            return redirect('/our-offers');
        }

        return $next($request);
    }
}
