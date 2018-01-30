<?php

namespace App\Http\Middleware;

use Closure;

class ProfileCompleted
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
        switch ($user->role) {
            case 'user':
               $user = auth()->user()->userprofile;
                if ($user->interests_status == 0) {
                    return redirect()->to('user/interests')
                           ->with('status','We Should Know More About You');
                }
                break;
            case 'retailer':
               
            break;
            
            default:
                # code...
            break;
        }     
        
        return $next($request);
    }
}
