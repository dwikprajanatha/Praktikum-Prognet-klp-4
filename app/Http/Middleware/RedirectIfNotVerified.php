<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

use App\User;

class RedirectIfNotVerified
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
        $user_id = Auth::id();

        //redirect if not login
        if(is_null($user_id)){

            return redirect()->route('user.login');

        }

        $user = User::where('id',$user_id)->first();

        // redirect if user not exists
        if(is_null($user)){
            
            return redirect()->route('user.login');

        }
  
        // redirect if user not verified
        if($user->status == "Pending"){

            return redirect()->route('email.verification');

        }


        return $next($request);
    }
}
