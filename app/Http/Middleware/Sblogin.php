<?php

namespace App\Http\Middleware;

use Closure;

class Sblogin
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

        $ss_login = session('sblogin');

        if (isset($ss_login) && ($ss_login)) {
            return $next($request);
        }

        return redirect('admin/login')->with('status', 'Please login to continue !');

    }
}
