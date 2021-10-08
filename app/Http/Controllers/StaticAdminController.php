<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Tuition;
use App\Models\Grade;
use App\Models\Scholarship;
use App\Models\TypePay;
use App\Models\Admin;
use App\Models\Bill;
use App\Models\Major;
use Carbon\Carbon;//Thu vien thoi gian
use DB;

class StaticAdminController extends Controller
{
    //
    public function dashboard(Request $request)
    {
        //get year
        $year = date('Y');
        if($request->year){
            $year = $request->year;
        }

        //Get data months
        $dataMonths = DB::table("bill")
        ->select(DB::raw("SUM(money) as total"),DB::Raw("month(dateTime) as months"))
        ->whereYear('dateTime',$year)
        ->where('idTypepay',1)//IDtypepay months = 1
        ->groupBy(DB::raw("month(dateTime)"))
        ->get();
        // dd($dataMonths);
        // dd()
        //Get data semeters
        $dataSemeters = DB::table("bill")
        ->select(DB::raw("SUM(money) as total"),DB::Raw("month(dateTime) as months"))
        ->whereYear('dateTime',$year)
        ->where('idTypepay',3)//ID typepay semeters = 2
        ->groupBy(DB::raw("month(dateTime)"))
        ->get();
        // dd($dataSemeters);
        //Get data years
        $dataYears = DB::table("bill")
        ->select(DB::raw("SUM(money) as total"),DB::Raw("month(dateTime) as months"))
        ->whereYear('dateTime',$year)
        ->where('idTypepay',2)//Idtypay year = 3
        ->groupBy(DB::raw("month(dateTime)"))
        ->get();

        
        $dataPointsMonths = array();
        $dataPointsSemeters = array();
        $dataPointsYears = array();
        foreach($dataMonths as $each) {
            $total = $each->total;
            $months  = $each->months;
            array_push($dataPointsMonths,array("y" => $total, "label" => "$months"));
        }
        foreach($dataSemeters as $each) {
            $total = $each->total;
            $months  = $each->months;
            array_push($dataPointsSemeters,array("y" => $total, "label" => "$months"));
        }
        foreach($dataYears as $each) {
            $total = $each->total;
            $months  = $each->months;
            array_push($dataPointsYears,array("y" => $total, "label" => "$months"));
        }

        // tinh tong so tien thu duoc trong thang
        $months = date('m');
        if($request->months){
            $months = $request->months;
        }
        
        $totalMoneyOfMonthArray = DB::table("bill")
        ->select(DB::raw("SUM(money) as totalMoney"),DB::Raw("month(dateTime) as months"))
        ->whereMonth('dateTime', $months)
        ->groupBy(DB::raw("month(dateTime)"))
        ->get();
        $totalMoneyOfMonth = array();
        $totalMoney = 0;
        foreach($totalMoneyOfMonthArray as $each) {
            $totalMoney += $each->totalMoney;
            array_push($totalMoneyOfMonth,array($totalMoney));
        }
        // dd($totalMoney);

        // so sv da nop trong thang
        $totalStudentIsArray = DB::table("bill")
        ->select(DB::raw("COUNT(DISTINCT(idStudent)) as totalStudent"))
        ->get();
        $totalStudentOfMonth = array();
        foreach($totalStudentIsArray as $each) {
            $totalStudent = $each->totalStudent;
            array_push($totalStudentOfMonth,array($totalStudent));
            // dd($totalStudent);
        }
        // dd($totalStudent);

        // User Registrations
        $totalUserRegistrationsIsArray = DB::table("student")
        ->select(DB::raw("COUNT(email) as totalUserRegistrations"))
        ->get();
        $totalUserRegistrationsOfYear = array();
        foreach($totalUserRegistrationsIsArray as $each) {
            $totalUserRegistrations = $each->totalUserRegistrations;
            array_push($totalUserRegistrationsOfYear,array($totalUserRegistrations));
        }
        // dd($totalUserRegistrations);

        // Total bill in month
        $totalBillIsArray = DB::table("bill")
        ->select(DB::raw("COUNT(id) as totalBill"))
        ->get();
        $totalBillOfYear = array();
        foreach($totalBillIsArray as $each) {
            $totalBill = $each->totalBill;
            array_push($totalBillOfYear,array($totalBill));
        }
        // dd($totalUserRegistrations);

        return view('admin.dashboard', compact('year','dataPointsMonths','dataPointsYears','dataPointsSemeters', 'totalMoney', 'totalStudent', 'totalUserRegistrations', 'totalBill'));
    }
}
