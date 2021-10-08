<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Major;
use App\Models\Course;

class GradeController extends Controller
{
    //Loc danh sach lop theo nganh hoac khoa
    public function filter(Request $request,$id){
        $key = $request->key;
        $major = Major::all();
        $data = Grade::orderBy('id', 'DESC')
        ->where('idMajor',$id)
        ->where('name','like', "%$key%")
        ->paginate(5);
        
        return view('admin.grade.index', compact('data', 'key','major','key'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->get('key');
        $major = Major::all();
        $course = Course::all();
        $data = Grade::orderBy('name', 'DESC')->where('name','like', "%$key%")->paginate(5);
        return view('admin.grade.index', compact('data', 'key','major'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Lấy ra tất cả các ngành hiện có 
        //Select * from major
        $major = Major::orderBy('name', 'ASC')->select('id', 'name')->get();
        //Lấy ra tất cả các khóa hiện có
        $course = Course::orderBy('name', 'ASC')->select('id', 'name')->get();
        return view('admin.grade.create', compact('major','course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|unique:grade,name,',
            'idCourse' => 'required',
            'idMajor' => 'required',
        ]);
        $grade = new Grade();
        $grade -> name = $request-> get('name');
        $grade -> idCourse = $request-> get('idCourse');
        $grade -> idMajor = $request-> get('idMajor');
        $grade -> save();
        return redirect()->route('grade.index')->with('success','Thành công!!');

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
        $grade = Grade::find($id);
        return $grade;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
        $major = Major::orderBy('name', 'ASC')->select('id', 'name')->get();
        $course = Course::orderBy('name', 'ASC')->select('id', 'name')->get();
        return view('admin.grade.edit', compact('grade','major','course'));
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
        //
        $grade = new Grade();
        $grade = Grade::find($id);
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('grade')->ignore($grade->id),
                ],
            'idCourse' => 'required',
            'idMajor' => 'required',
        ]);
        $grade -> name = $request -> get('name');
        $grade -> idCourse = $request -> get('idCourse');
        $grade -> idMajor = $request -> get('idMajor');
        $grade -> save();
        return redirect(route('grade.index'))->with('success','Update grade success');
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
        // Student::where('id', $id)->delete();
        // Grade::find($id)->delete();
        
        // return redirect()->route('grade.index');
    }
}
