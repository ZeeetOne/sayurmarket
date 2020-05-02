<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAdmin
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
        $role = Auth::user()['role']; 
        if (Auth::check()) {
            if ($role != 1) {
                return redirect(route('home'))->with(['alert' => 'Forbidden Access. Admin Only']);
            }
        }
        return $next($request);
    }
}
