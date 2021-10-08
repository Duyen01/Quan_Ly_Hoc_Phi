<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->get('key');
        $data = Scholarship::orderBy('id', 'ASC')->where('money','like', "%$key%")->paginate(5);
        return view('admin.scholarship.index', compact('data', 'key'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.scholarship.create');
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
            'money' => 'required|numeric|unique:scholarship,money|min:1',
        ]);
        
        $scholarship = new Scholarship();
        $scholarship -> money = $request-> get('money');
        $scholarship -> save();
        return redirect()->route('scholarship.index')->with('success','Create scholarship success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $scholarship = Scholarship::find($id);
        return $scholarship;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Scholarship $scholarship)
    {
        return view('admin.scholarship.edit', compact('scholarship'));
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
        $scholarship = new Scholarship();
        $scholarship = Scholarship::find($id);
        $this->validate($request,[
            'money' => [
                'required',
                Rule::unique('scholarship')->ignore($scholarship->id),'numeric','min:1'
            ],
        ]);
        
        $scholarship -> money = $request -> get('money');
        $scholarship -> save();
        return redirect(route('scholarship.index'))->with('success','Update scholarship success');
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
