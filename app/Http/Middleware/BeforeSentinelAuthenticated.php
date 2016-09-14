<?php

namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
class BeforeSentinelAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Sentinel::check()) 
        {
            return redirect('admin/login')->withInput()->withErrors(array('message' => 'You must be login!'));
        }
          
        return $next($request);
        
    }
}
