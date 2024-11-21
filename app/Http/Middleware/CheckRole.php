<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if(in_array($request->user()->role, $roles)){
            return $next($request);
        }

        if(Auth::user()->role == 'admin'){
            return Redirect::to('dashboard');
        } elseif(Auth::user()->role == 'nasabah'){ 
            return Redirect::to('jadwalnasabah');
        } elseif(Auth::user()->role == 'sopir'){
            return Redirect::to('jadwalsopir');
        }
    }
}
