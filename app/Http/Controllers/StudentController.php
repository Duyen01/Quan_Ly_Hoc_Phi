<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Scholarship;
use App\Models\TypePay;
use App\Models\Bill;
use App\Models\Tuition;
use App\Models\Major;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;



class StudentController extends Controller
{
    //Login
    public function login(){
        return view('login');
    }
    //processLogin
    public function loginProcess(Request $request){
        $email = $request->get('email');
        $password = $request->get('password');
        try{
            $student = Student::where('email', '=', $email)->first();
            $newPass = $student->password;
            if (Hash::needsRehash($newPass)) {
                $newPass = Hash::make($newPass);
            }
            if (Hash::check($password, $newPass)) {
                // code...
                $request->session()->put('student', $student);
                return Redirect::route('home')->with('success','Đăng nhập thành công');
            }else{
                return Redirect::route('login')->with('error','Sai du lieu');
            }
        }catch(Exception $e){
            echo "Dang nhap that bai";
            return Redirect::route('login')->with('error','Sai du lieu');
        }
       
    }
    //Log out
     public function logout(Request $request){
        $request->session()->flush();
        return Redirect::route('login');
    }
    //Import function
    public function import(Request $request)
    {
         $request->validate([
            'imported_file' => 'required',
        ]);
        if ($request->file('imported_file')) {
            $imported_file = $request->file('imported_file');
            Excel::import(new StudentsImport(), request()->file('imported_file'));
            return redirect()->route('student.index', compact('imported_file'))->with('success','Imported Successfully');
        }
    }
    //Export function
    public function export(Request $request)
    {
        $request->validate([
            'grade' => 'required',
        ]);

        $id = $request -> get('grade');
        $file = Excel::download(new StudentsExport($id), 'students_'.time().'.xlsx');
        return $file;
    }
    // //View profile student
    public function profile(Request $request){
        $id = $request->session()->get('student.id');
        $student = Student::find($id);
        return view('student.profile', compact('student'));
    }
    //Change pass student
    public function admin_credential_rules(array $data)
    {
        $messages = [
            'oldpassword.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
        ];

        $validator = Validator::make($data, [
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',     
        ], $messages);

        return $validator;
    }  
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',   
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $id = $request->session()->get('student.id');
        // dd($id);
        $student = Student::find($id);

        // $student->update($request->only('password'));
        $password = Hash::make($request->password);
        $request->merge(['password' => $password]);
        $student->update($request->only('password'));
   
        return response()->json(['success'=>'Data is successfully added']);
    }
    //End change pass
    //Live search
    public function search(Request $request)
    {
        {
        if ($request->ajax()) {
            $key = $request->get('key');//Key tim kiem
            $data = Student::select('student.*','FULLNAME.fullname as fullname','grade.name as nameGrade','scholarship.money as money','typepay.typeofpay as typeofpay')
            ->join('FULLNAME','student.id','=','FULLNAME.idStudent')
            ->join('grade','idGrade','=','grade.id')
            ->join('scholarship','idScholarship','=','scholarship.id')
            ->join('typepay','idTypePay','=','typepay.id')
            ->where('fullname','like', "%$key%")->orwhere('lastname','like', "%$key%")->get();

            $output = '';
            if ($data) {
                foreach ($data as $key => $student) {
                    $gender = $student->gender == 1? "Nam":"Nữ";
                    $link_edit = route('student.edit',$student->id);
                    $link_show = route('student.detail',$student->id);
                    $output .= '<tr>
                    <td>' . $student->firstname . '</td>
                    <td>' . $student->lastname . '</td>
                    <td>' . $gender . '</td>
                    <td>' . $student->nameGrade . '</td>
                    <td>' . $student->email . '</td>
                    <td>' . $student->phone . '</td>
                    <td>' . $student->dob . '</td>
                    <td>' . '<a href="'.$link_edit.'"><i class="fas fa-edit"></i></a>' . '</td>
                    <td>' . '<a href="'.$link_show.'"><i class="fas fa-eye"></i></a>' . '</td>
                    </tr>';
                }
            }
            
            return Response($output);
        }
    }
    }
    //End livesearch
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $key = $request->get('key');
        $grades = Grade::orderBy('name','ASC')->get();
        $data = Student::orderBy('id', 'ASC')->get();
        return view('admin.student.index', compact('data', 'grades'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grade = Grade::orderBy('name', 'ASC')->select('id', 'name')->get();
        $typepay = TypePay::orderBy('typeOfPay', 'ASC')->select('id', 'typeOfPay')->get();
        $scholarship = Scholarship::orderBy('money', 'ASC')->select('id', 'money')->get();
        return view('admin.student.create', compact('grade', 'typepay', 'scholarship'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student();
        $this->validate($request, [
            'firstName' => 'required|min:2',
            'lastName' => 'required|min:2',
            'gender' => 'required',
            'address' => 'required|min:2',
            'phone' => 'required|unique:student,phone|numeric',
            'dob' => 'required',
            'idGrade' => 'required',
            'idScholarship' => 'required',
            'idTypePay' => 'required',
            // 'status' => 'required',
            'email' => 'required|unique:student',
            'password' => 'required'
        ]);
        $student -> firstName = $request->get('firstName');
        $student -> lastName = $request->get('lastName');
        $student -> gender = $request-> get('gender');
        $student -> address = $request-> get('address');
        $student -> phone = $request-> get('phone');
        $student -> dob = $request-> get('dob');
        $student -> idGrade = $request-> get('idGrade');
        $student -> idScholarship = $request-> get('idScholarship');
        $student -> idTypePay = $request-> get('idTypePay');
        $student -> email = $request-> get('email');
        //Hash password
        // $student -> status = $request-> get('status');
        $password = $request->get('password');
        $password = Hash::make($password);
        $student -> password = $password;
        //End hash

        $student -> save();
        return redirect()->route('student.index')->with('success','Create a new student success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return $student;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $grade = Grade::all();
        $scholarship = Scholarship::all();
        $typepay = TypePay::all();
        return view('admin.student.edit',compact('student', 'grade', 'scholarship', 'typepay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = new Student();
        $student = Student::findOrFail($id);
        $this->validate($request, [
            'firstName' => 'required|min:2',
            'lastName' => 'required|min:2',
            'gender' => 'required',
            'address' => 'required|min:2',
            'phone' => [
                'required',
                Rule::unique('student')->ignore($student->id),'numeric',
            ],
            'dob' => 'required',
            'idGrade' => 'required',
            'idScholarship' => 'required',
            'idTypePay' => 'required',
            // 'status' => 'required',
            'email' => [
                'required',
                Rule::unique('student')->ignore($student->id),'email',
            ],
            'password' => 'required'
        ]);
        $student -> firstName = $request->get('firstName');
        $student -> lastName = $request->get('lastName');
        $student -> gender = $request-> get('gender');
        $student -> idGrade = $request-> get('idGrade');
        $student -> idScholarship = $request-> get('idScholarship');
        $student -> idTypePay = $request-> get('idTypePay');
        $student -> email = $request-> get('email');
        $student -> phone = $request-> get('phone');
        //Hash password
        if(!empty($request->get('password'))){
            $password = $request-> get('phone');
            $password = Hash::make($password);
            $student -> password = $password;
        }
        
        //End hash
        $student->save();
        return redirect(route('student.index'))->with('success','Updated');
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
        Student::find($id)->delete();
        return redirect(route('student.index'))->with('success','Xóa thành công!');
    }
//Trang chủ thống kê sinh viên người dùng 
    public function dashboard(Request $request){
        try {
            //Id sinh viên hiện tại 
        $id = $request->session()->get('student.id');
        //Thông tin cơ bản sinh viên
            $student = new Student();
            $student = Student::findOrFail($id);
        //Số lần sinh viên đã đóng học phí = tháng + kỳ + năm 
            $so_lan_da_dong = Bill::selectRaw('idTypepay,COUNT(*) as so_luong')->where('idStudent','=',$id)->groupByRaw('idTypepay')->get();
        //Type pay 
            $chiet_khau = TypePay::all();
        //Định mức học phí của sinh viên = 3 năm
            $idMajor = Grade::select('grade.idMajor as idMajor')
            ->join('student','student.idGrade','=','grade.id')
            ->where('student.id','=',$id)->firstOrFail();
            $idCourse = Grade::select('grade.idCourse as idCourse')
            ->join('student','student.idGrade','=','grade.id')
            ->where('student.id','=',$id)->firstOrFail();
            $so_tien_dinh_muc_sv = Tuition::select('tuition.tuitionNorm as tuitionNorm')
            ->whereIn('tuition.idMajor',$idMajor)
            ->whereIn('tuition.idCourse',$idCourse)
            ->first();
            $so_tien_dinh_muc = $so_tien_dinh_muc_sv->tuitionNorm;
        //Học bổng của sinh viên
            $hoc_bong = Scholarship::select('scholarship.money as money')
            ->join('student','student.idScholarship','=','scholarship.id')
            ->where('student.id','=',$id)
            ->firstOrFail();
            $hoc_bong_sinh_vien = $hoc_bong->money;
        //SỐ tiền đóng 1 tháng = (định mức - học bổng) / 30
            $so_tien_mot_thang = ($so_tien_dinh_muc - $hoc_bong_sinh_vien) / 30;
        //Số lần đóng theo tháng, kì, năm tương ứng => tổng số tháng đã đóng 
            $so_lan_theo_thang = 0;
            $so_lan_theo_ky = 0;
            $so_lan_theo_nam = 0;
            $tong_tien = 0;
            for ($i=0; $i < count($so_lan_da_dong); $i++) { 
                // code...
                $so_lan_da_dong[$i]->idTypepay == '1'? $so_lan_theo_thang += $so_lan_da_dong[$i]->so_luong : $so_lan_theo_thang += 0;//Tổng số lần theo tháng
                    
                $so_lan_da_dong[$i]->idTypepay == '2'? $so_lan_theo_ky += $so_lan_da_dong[$i]->so_luong : $so_lan_theo_ky += 0;
                    
                $so_lan_da_dong[$i]->idTypepay == '3'? $so_lan_theo_nam += $so_lan_da_dong[$i]->so_luong : $so_lan_theo_nam += 0;
                    
            }
            $so_thang_da_dong = $so_lan_theo_thang + $so_lan_theo_ky * 5 + $so_lan_theo_nam * 10;//So sanh voi so thang phai dong den hien tai
        //Tổng tiền đã đóng của sv 
            $tong_tien += $so_lan_theo_thang * $so_tien_mot_thang * (1-($chiet_khau[0]->discount)/100);
            $tong_tien += $so_lan_theo_ky * $so_tien_mot_thang * 5 * (1-($chiet_khau[1]->discount)/100);
            $tong_tien += $so_lan_theo_nam * $so_tien_mot_thang * 10 *  (1-($chiet_khau[2]->discount)/100);
        //Ngày bắt đầu tính học phí của sinh viên 
            $ngay_nhap_hoc = Major::select('dayAdmission as ngay_nhap_hoc')
            ->join('grade','idMajor','=','major.id')
            ->join('student','idGrade','=','grade.id')
            ->where('student.id','=',$id)
            ->firstOrFail();
            $ngay_bat_dau = $ngay_nhap_hoc->ngay_nhap_hoc;
            // dd($ngay_bat_dau);
            $now = Carbon::now();//Thoi gian hien tai
        //Số tháng cần đóng đến hiện tại 
            $so_thang_den_hien_tai = $now->diffInMonths($ngay_bat_dau);//So sanh voi so thang da dong
        //Số tháng còn phải đóng
            $so_thang_phai_dong = $so_thang_den_hien_tai - $so_thang_da_dong;
        //Tình trạng học phí 
            if($so_thang_da_dong < $so_thang_den_hien_tai){
                $status = false;
            }else{
                $status = true;
            }
        //Thống kê học phí đã đóng 
            // $month = date('m');
            $year = date('Y');
            
            $data = DB::table("bill")
            ->select(DB::raw("SUM(money) as total"),DB::Raw("month(dateTime) as months"))
            ->whereYear('dateTime',$year)
            ->where('idStudent',$id)
            ->groupBy(DB::raw("month(dateTime)"))
            ->get();
            $count = COUNT($data);
            $dataPoints = array();
            foreach($data as $each) {
                $total = $each->total;
                $months  = $each->months;
                array_push($dataPoints,array("y" => $total, "label" => "$months"));
            }
            return view('student.home', compact('so_lan_theo_nam','so_lan_theo_thang','so_lan_theo_ky','student','status','tong_tien','dataPoints','count','so_thang_phai_dong','ngay_bat_dau','id','year'));
            } catch (ModelNotFoundException $exception) {
                return back()->withError('Đã xảy ra lỗi!')->withInput();
            }
        
    }

    public function history(Request $request){
        $id = $request->session()->get('student.id');
         //HIển thị bill sinh viên đã đóng
        $bill = Bill::select('bill.*','admin.name as nameAdmin')
            ->join('admin','admin.id','=','bill.idAdmin')
            ->where('bill.idStudent',$id)
            ->orderBy('bill.id','DESC')
            ->paginate(5);
        return view('student.history', compact('bill'));
    }
}
