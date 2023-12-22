<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user=$request->session()->get('user');
        if(isset($user))
        {
            return $next($request);
        }
        else
        {
            echo "<script>alert('Please login...')
            window.location.href='/login';
            </script>";
        }
       
    }
}
