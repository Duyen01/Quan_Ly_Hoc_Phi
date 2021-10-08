<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->get('key');
        $data = Major::orderBy('id', 'DESC')->where('name','like', "%$key%")->paginate(5);
        return view('admin.major.index', compact('data', 'key'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.major.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:major,name|min:2',
        ]);
        $major = new Major();
        $major -> name = $request-> get('name');
        $major -> dayAdmission = $request-> get('dayAdmission');
        $major -> save();
        return redirect()->route('major.index')->with('success','Create major success');
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
        $major = Major::find($id);
        return $major;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Major $major)
    {
        //
        return view('admin.major.edit', compact('major'));
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
        $major = new Major();
        $major = Major::find($id);
        $this->validate($request,[
            'name' => [
                'required',
                Rule::unique('major')->ignore($major->id),'min:2',
            ],
        ]);
        
        $major -> name = $request -> get('name');
        $major -> dayAdmission = $request-> get('dayAdmission');
        $major -> save();
        return redirect(route('major.index'))->with('success','Update major success');
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
