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


class StaticController extends Controller
{
    //
    public function statusStudent(Request $request, $id){
        try {
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
            ->firstOrFail();
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
            if($request->year){
                $year = $request->year;
            }
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
            //HIển thị bill sinh viên đã đóng
            $bill = Bill::select('bill.*','admin.name as nameAdmin')
                ->join('admin','admin.id','=','bill.idAdmin')
                ->where('bill.idStudent',$id)
                ->orderBy('bill.id','DESC')
                ->paginate(5);
            return view('admin.student.show', compact('so_lan_theo_nam','so_lan_theo_thang','so_lan_theo_ky','student','status','tong_tien','dataPoints','count','so_thang_phai_dong','ngay_bat_dau','id','year','bill','year'));
            } catch (ModelNotFoundException $exception) {
                return back()->withError('Đã xảy ra lỗi!')->withInput();
            }
        
    }
    
}
