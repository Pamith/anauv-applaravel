<?php

namespace App\Http\Middleware;

use Closure;

class RetailerMiddleware
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
        if (!$user) {
              return redirect()->to('/');
         }
        if ($user->role =='user') {
           return redirect()->to('user/');
        }
        return $next($request);
    }
}
