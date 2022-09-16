<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserType
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
        // $check = false;

        // if ($user = auth()->user()) {
        //     if ($user->user_type === $userType) {

        //         $check = true;

        //     }
        // }

        //     if ($check === false) {
        //         if ($userType === 'admin') {
        //             return redirect()->route('login')->withErrors(['email' => ['Anda harus login sebagai super admin terlebih dahulu.']]);
        //         }
        //         else{
        //             return redirect()->route('login_user')->withErrors(['email' => ['Anda harus login sebagai kader desa terlebih dahulu.']]);
        //         }


        // }
        // return $next($request);
        if (Auth::check() && Auth::user()->user_type == 'admin') {
            return $next($request);
        }

        return redirect('/dashboard_user');

    }
}