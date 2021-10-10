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
use Illuminate\Support\Facades\DB;

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
        

        return view('admin.dashboard', compact('year','dataPointsMonths',
        'dataPointsYears','dataPointsSemeters', 'totalMoney', 'totalStudent', 
        'totalUserRegistrations', 'totalBill'));
    }

    public function student(Request $request)
    {
        $arrayTyepPayCousesMajor = DB::select(DB::raw("
        select DISTINCT(course.id) as idCourse, course.name as nameCourse, student.idTypePay, major.id as idMajor, major.name as nameMajor from grade 
        join student on student.idGrade = grade.id 
        join course on course.id = grade.idCourse 
        join major on major.id = grade.idMajor
        "));

        $arrayStudentTypayCourseMajor = array();
        $arrayCourse = array();
        $arrayMajor = array();

        foreach($arrayTyepPayCousesMajor as $each){
        
            // $request->course === null ? $each->idCourse : $request->course
            $typePayAndCoursesMajor = DB::select(DB::raw("
            select DISTINCT(student.idTypePay) AS TYPE_PAY, 
            COUNT(DISTINCT(student.lastname)) as student_typepay,
            list_tuition.nameCouse, student_major.name, typepay.typeofpay
            from student 
            right join list_tuition on student.idGrade = list_tuition.ID_GRADE
            join student_major on student.idGrade = student_major.MA_LOP
            join typepay on student.idTypePay = typepay.id
            where student.idTypePay = '$each->idTypePay'
            and list_tuition.id_course = '$each->idCourse'
            and student_major.MA_NGANH = '$each->idMajor'
            group by student.idTypePay, list_tuition.nameCouse, typepay.typeofpay, student_major.name
            "));

            // dd($typayAndCourses);
            foreach($typePayAndCoursesMajor as $item){
                array_push($arrayStudentTypayCourseMajor, $item);                
            }
            array_push($arrayCourse, array($each->idCourse, $each->nameCourse));
            array_push($arrayMajor, array($each->idMajor, $each->nameMajor));
        }

        return response()->json([
            "arrayCourse" => $arrayCourse,
            "arrayMajor" => $arrayMajor,
            "arrayStudentTypayCourseMajor" => $arrayStudentTypayCourseMajor
        ]);

    }
}
