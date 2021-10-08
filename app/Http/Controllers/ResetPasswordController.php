<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Mail;
use Session;
use DB;
use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;



class ResetPasswordController extends Controller
{
    //
   public function recover_pass(Request $request){
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "Lấy lại mật khẩu Trang quan tri".' '.$now;
        $admin = Admin::where('email','=',$data['email_account'])->get();
        foreach($admin as $key => $value){
            $admin_id = $value->id;
        }
        
        if($admin){
            $count_admin = $admin->count();
            if($count_admin==0){
                return redirect()->back()->with('error', 'Email chưa được đăng ký để khôi phục mật khẩu');
            }else{
                $token_random = Str::random();
                $admin = Admin::find($admin_id);
                $admin->admin_token = $token_random;
                $admin->save();
                //send mail
              
                $to_email = $data['email_account'];//send to this email
                $link_reset_pass = url('/admin/update-new-pass?email='.$to_email.'&token='.$token_random);
             
                $data = array("name"=>$title_mail,"body"=>$link_reset_pass,'email'=>$data['email_account']); //body of mail.blade.php
                
                Mail::send('admin.password.forget_pass_notify', ['data'=>$data] , function($message) use ($title_mail,$data){
                    $message->to($data['email'])->subject($title_mail);//send this mail with subject
                    $message->from($data['email'],$title_mail);//send from this mail
                });
                //--send mail
                return redirect()->back()->with('success', 'Gửi mail thành công,vui lòng vào email để reset password');
            }
        }
    }
    public function reset_new_pass(Request $request){
        $data = $request->all();
        $this->validate($request, [
            'password' => 'confirmed'
        ]);
        $token_random = Str::random();
        $admin = Admin::where('email','=',$data['email'])->where('admin_token','=',$data['token'])->get();
        $count = $admin->count();
        if($count>0){
                foreach($admin as $key => $cus){
                    $admin_id = $cus->id;
                }
                $reset = Admin::find($admin_id);
                $reset->password = Hash::make($data['password']);
                $reset->admin_token = $token_random;
                $reset->save();
                return redirect()->route('admin.login')->with('success', 'Mật khẩu đã cập nhật mới,vui lòng đăng nhập');
        }else{
            return redirect()->route('quen_mat_khau')->with('error', 'Vui lòng nhập lại email vì link đã quá hạn');
        }
    }
    public function update_new_pass(Request $request){

        return view('admin.password.new_pass'); //1
    }
    public function quen_mat_khau(Request $request){
        return view('admin.password.forget_pass'); //1
        
    }
}
