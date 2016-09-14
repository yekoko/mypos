<?php

namespace App\Http\Middleware;
use Sentinel;
use Closure;

class RoleMiddleware
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
        if ($user = Sentinel::getUser())
        {
            if (!$user->inRole('admin'))
            {
                 return redirect('admin/dashboard')->withInput()->withErrors(array('message' => 'You are not admin user!'));
            }
        }

        return $next($request);
    }
}
