<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Major;
use App\Models\Tuition;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
class TuitionController extends Controller
{
    //
    public function index(Request $request)
    {
        $key = $request->get('key');
        // $data = Tuition::where('tuitionNorm','like', "%$key%")->paginate(5);
        $data = DB::table('tuition')
        ->select('tuitionNorm','major.name as major_name','course.name as course_name','idMajor','idCourse')
        ->join('major','idMajor','=','major.id')
        ->join('course','idCourse','=','course.id')
        ->where('tuitionNorm','like', "%$key%")
        ->paginate(5);
        
        return view('admin.tuition.index', compact('data', 'key'));
    }

    public function create()
    {
        $cou = Course::orderBy('name', 'ASC')->select('id', 'name')->get();
        $maj = Major::orderBy('name', 'ASC')->select('id', 'name')->get();
        return view('admin.tuition.create', compact('cou', 'maj'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'idCourse' => 'required',
            'idMajor' => 'required',
            'tuitionNorm' => 'required',
        ]);
        $tuition = new Tuition();
        $tuition -> idCourse = $request->get('idCourse');
        $tuition -> idMajor = $request->get('idMajor');
        $tuition -> tuitionNorm = $request-> get('tuitionNorm');
      /*  print_r($tuition->idCourse."-");
        print_r($tuition->idMajor."-");
        print_r($tuition->tuitionNorm."-");*/
        // die();
        $tuition -> save();
        return redirect()->route('tuition.index')->with('success','Create tuition success');
    }

    public function edit(Request $request)
    {
        //
        $idCourse = $request->idCourse;
        $idMajor = $request->idMajor;
        // dd($idMajor);
        // $tuition = Tuition::where('idCourse',$idCourse)->where('idMajor',$idMajor)->first();
        $tuition = Tuition::where([['idCourse','=',$idCourse],['idMajor','=', $idMajor]])->first();

        // dd($tuition);
        // return view('admin.tuition.edit', compact('tuition'));
        return response()->json(['tuition'=>$tuition]);
    }

     public function update(Request $request)
    {
        //
        $this->validate($request,[
            // 'idCourse' => 'required',
            // 'idMajor' => 'required',
            'tuitionNorm' => 'required',
        ]);
        $idCourse = $request->courseUpdate;
        $idMajor = $request->majorUpdate;
        $tuitionNorm = $request->tuitionNorm;
        Tuition::where(['idCourse' => $idCourse, 'idMajor' => $idMajor])->update($request->only('tuitionNorm'));

        return response()->json(['success' => 'Update tuition success']);
    }

}
