<?php

namespace App\Http\Middleware;

use Closure;

class LoginRoleMiddleware
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
        $user = auth()->user();
        if ($user->role =='retailer') {
           return redirect()->to('retailer/');
        }
        else{
            return redirect()->to('user/');
        }
        return $next($request);
    }
}
