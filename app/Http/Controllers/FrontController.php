<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\Bill;
use App\Models\TypePay;
use Mail;
class FrontController extends Controller
{
    public function addFeedback(Request $request)
    {
        $id = $request->get('idBill');
        $bill = Bill::find($id);
        $idTypepay = $bill->idTypepay;
        $typepay = TypePay::where('id',$idTypepay)->first();
        $email = $bill->student->email;
        $name = $bill->student->lastname;
        Mail::send('admin.bill.mailfb', compact('bill','typepay'), function($message) use ($email, $name){
            $message->to($email)->subject('Học phí sinh viên '.$name);
        });
        return Redirect::route('bill.index')->with('success','Đã gửi email!');
    }
}