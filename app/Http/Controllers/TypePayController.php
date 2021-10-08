<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypePay;
use Illuminate\Validation\Rule;


class TypePayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $key = $request->get('key');
        $data = TypePay::where('typeOfPay','like', "%$key%")->paginate(5);
        return view('admin.typepay.index', compact('data', 'key'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.typepay.create');
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
            'typeOfPay' => 'required|unique:typepay,typeOfPay',
            'discount' => 'required',
            'begin' => 'required_with:end|lte:end|integer',
            'end' => 'required_with:begin|integer|gte:begin',
        ]);
        $typepay = new TypePay();
        $typepay -> typeOfPay = $request->get('typeOfPay');
        $typepay -> discount = $request->get('discount');
        $typepay -> begin = $request->get('begin');
        $typepay -> end = $request-> get('end');
        $typepay -> save();
        return redirect()->route('typepay.index')->with('success','Create type of pay success');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $typepay = TypePay::findOrFail($id);
        return view('admin.typepay.edit',compact('typepay'));
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
        $typepay = new TypePay();
        $typepay = TypePay::findOrFail($id);
        $this->validate($request,[
            'typeofpay' => [
                'required',
                Rule::unique('typepay')->ignore($typepay->id),
            ],
            'discount' => 'required',
            'begin' => 'required',
            'end' => 'required',
        ]);
        $typepay -> discount = $request -> get('discount');
        $typepay -> typeofpay = $request -> get('typeofpay');
        $typepay -> begin = $request -> get('begin');
        $typepay -> end = $request -> get('end');
        $typepay -> save();
        return redirect(route('typepay.index'))->with('success','Update typepay success');
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
