<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DesignerMiddleware
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
        // if(Auth::check())
        // {
        //     if(Auth::user()->role_as == '2')//designer
        //     {
        //         return redirect('/');
        //     }
           
        // }
        // else
        // {
        //     return redirect('/home')->with('status','Please Login First');
        // }
    }
}
