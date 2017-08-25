<?php

namespace App\Http\Middleware;

use App\Car;
use Closure;
use Illuminate\Support\Facades\Session;

class CarOwner
{

    public function handle($request, Closure $next)
    {
        if($request->route('car')->user_id != auth()->id()){
            Session::flash('error', "This car is not yours!! You are not authorized to access that page.");
            return back();
        }

        return $next($request);
    }

}
