<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class CheckLogin
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
        if ($request->session()->exists('admin')) {
            return $next($request);//này là đã đăng nhập thì đi tiếp đến cái route bên dưới ở wweb
        }else{//Neu chua dang nhap
            return Redirect::route('admin.login')->with('error','Hic. Đăng nhập đi đã mà!!');
        }
    }
}
