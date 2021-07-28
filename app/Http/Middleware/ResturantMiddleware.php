<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResturantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if((session()->has('users') && session()->get('users')['user_type'] == 2 && session()->get('users')['is_profile_complete'] == 1))
        {
            return $next($request);
        }
        else
        {
            Auth::logout();           
            $request->session()->flush();            
            return redirect("/login_page");
        }
    }
}
