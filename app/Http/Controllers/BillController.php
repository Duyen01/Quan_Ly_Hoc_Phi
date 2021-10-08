<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Student;
use App\Models\Bill;
use App\Models\Grade;
use Illuminate\Support\Facades\Validator;



class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo "Hello Cau";
        $key = $request->get('key');
        $bill = Bill::select('bill.*','STUDENT_BILL.*','admin.name as nameAdmin','FULLNAME.fullname as fullname')
        ->join('STUDENT_BILL','STUDENT_BILL.idS','=','bill.idStudent')
        ->join('admin','admin.id','=','bill.idAdmin')
        ->join('FULLNAME','FULLNAME.idStudent','=','bill.idStudent')
        ->orderBy('bill.id','DESC')
        ->where('fullname','like',"%$key%")
        ->paginate(5);
        return view('admin.bill.index', compact('bill','key'));
    }
    public function create(Request $request)
    {
        $grade = Grade::all();
        $search = $request->search;
        $student = Student::orderBy('id', 'ASC')->search()->paginate(5);
        return view('admin.bill.create', compact('student', 'search', 'grade'));
    }
    public function filter(Request $request, $idGrade)
    {
        $grade = Grade::all();
        $search = $request->search;
        $student = Student::select('student.*')
            ->join('grade', 'grade.id', '=', 'student.idGrade')
            ->where('grade.id', $idGrade)
            ->Search()->paginate(5);
        return view('admin.bill.create', compact('student', 'search', 'grade'));
    }
    public function add(Request $rq)
    {
        $id = $rq->id;
        $student = Student::select('student.id as idStudent','typepay.id as idTypePay','typepay.typeofpay as typeofpay','student.firstname as firstname','student.lastname as lastname')
        ->join('typepay', 'student.idTypePay', '=', 'typepay.id')
        // ->join('bill','student.id','=','bill.idStudent')
        ->where('student.id','=',$id)->first();
        $studentTuition = Student::join('LIST_TUITION', 'LIST_TUITION.id_grade', '=', 'student.idGrade')->where('student.id', $id)->first();
        $studentScholarship = Student::join('scholarship', 'scholarship.id', '=', 'student.idScholarship')->where('student.id', $id)->first();

        // dd($studentTuition);
        return response()->json([
           "student" => $student,
           "studentTuition" => $studentTuition,
           "studentScholarship" => $studentScholarship,
       ]);
    }
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'idStudent' => 'required',
            'idTypePay' => 'required',
            'idAdmin' => 'required',   
            'money' => 'required|numeric',   
            'note' => 'required',   
            'dateTime' => 'required|date',   
        ]);
        if ($validator->fails()) {
            return redirect()->route('bill.create')->with('error','Something went wrong!');
        } else {
        $data = $request->only('idStudent', 'idTypePay', 'idAdmin', 'money', 'note','dateTime');
            if(Bill::create($data)){
                return redirect()->route('bill.index')->with('success','Added a bill!');
            }
        }
        // $data = $request->only('idStudent', 'idTypePay', 'idAdmin', 'money', 'note','dateTime');
        // if(Bill::create($data)){
        //     return redirect()->route('bill.index')->with('success','Added a bill!');
        // }else{
        //     return redirect()->route('bill.create')->with('error','Something went wrong!');
        // }
    }

    public function detail($id)
    {
        $student = Student::select('student.*','admin.name as nameAdmin','typepay.typeofpay as typeofpay','bill.money as money','bill.dateTime as dateTime','bill.note as note')
        ->join('bill', 'student.id', '=', 'bill.idStudent')
        ->join('admin','admin.id','=','bill.idAdmin')
        ->join('typepay','typepay.id','=','bill.idTypePay')
        ->where('bill.id', $id)
        ->firstOrFail();
        // dd($student);
        return view('admin.bill.show', compact('student'));
    }
}
