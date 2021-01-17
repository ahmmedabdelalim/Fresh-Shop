<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAge
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
        // login middleware 
        //$age = Auth::user()->age;
        if($request-> user() && $request->user()-> age < 15)
        {
            return redirect() -> route('NotAllowed');
        }
        return $next($request);
    }
}
