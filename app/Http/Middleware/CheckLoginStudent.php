<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class CheckLoginStudent
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
        if ($request->session()->exists('student')) {//Neu chua dang nhap, khong co session
            return $next($request);
        }else{//Neu chua dang nhap
            return Redirect::route('login')->with('error','Đăng nhập dồi mới được zô nha!!');
        }
    }
}
