<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProfileUpdate
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
        $user = Auth::user();
        $checkUser = [
            $user->surname, $user->othername, $user->name, $user->email, $user->phone, $user->religion, $user->lga,
            $user->bank_name, $user->account_name, $user->account_number, $user->bank_code
        ];
        if (count(array_filter($checkUser)) == sizeof($checkUser)) {
            return $next($request);
        }

        return redirect('/profile');
        
        
    }
}
