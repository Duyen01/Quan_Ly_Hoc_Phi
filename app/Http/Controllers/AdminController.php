<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Session;
use DB;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Admin;
use App\Models\Bill;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Login

    public function login(Request $request){
        $key = 'login'.$request->ip();
        // $retries = RateLimiter::retriesLeft($key, 3);
        // $seconds = RateLimiter::availableIn($key);
        return view('admin.login', [
            'key'=>$key,
            'retries'=>RateLimiter::retriesLeft($key, 3),
            'seconds'=>RateLimiter::availableIn($key),
        ]);
    }
    //Process Login
    public function loginProcess(Request $request){
        
        $email = $request->get('email');
        $password = $request->get('password');
        
        try{
            $admin = Admin::where('email', '=', $email)->first();
            $newPass = $admin->password;
            if (Hash::needsRehash($newPass)) {
                // $newPass = Hash::make($newPass);
                $newPass = bcrypt($newPass);
            }
            if (Hash::check($password, $newPass)) {
                // code...
                $request->session()->put('admin', $admin);
                Session::flash('message','Đăng nhập thành công');
                return Redirect::route('admin.dashboard')->with('success','Đăng nhập thành công');
            }else{
                Session::flash('error','Sai dữ liệu');
                return Redirect::route('admin.login')->with('error','Sai du lieu');
            }
        }catch(Exception $e){
            return Redirect::route('admin.login')->with('error','Sai du lieu');
        }
       
    }
    //Log out
    public function logout(Request $request){
        $request->session()->flush();
        return Redirect::route('admin.login');
    }
    //Dashboard admin
   
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //Edit infor admin
    public function edit()
    {
        //
        $id = session()->get('admin.id');
        $admin = Admin::find($id);
        return view('admin.edit', compact('admin'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $admin = new Admin();
        $id = session()->get('admin.id');
        $this->validate($request, [
            'name' => 'required|min:2|max:50',
            // 'email' => 'unique:admin,email',
            'email' => 'unique:admin,email,'.$id,
            'password' => 'confirmed'
        ]);
        $admin = Admin::find($id);
        $admin -> name = $request->get('name');
        $admin -> email = $request->get('email');
        //Hash password
        $oldpassword = $request->get('oldpassword');
        $password = $request->get('password');
        if (!empty($password)) {
            // code...
            if (Hash::needsRehash($password)) {
                $password = Hash::make($password);
            }
            $admin -> password = $password;
        }else{
            if (Hash::needsRehash($oldpassword)) {
                $oldpassword = Hash::make($oldpassword);
            }
            $admin -> password = $oldpassword;
        }
       
        //End hash
        $admin -> save();
        return redirect()->back()->with('success','Updated admin information!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
