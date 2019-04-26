<?php

namespace App\Http\Controllers;


use App\ChuyenNganh;
use App\Khoa;
use App\MonHoc;
use Illuminate\Http\Request;

class MonHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\Http\Resources\MonHoc::collection(MonHoc::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chuyennganh=ChuyenNganh::all();
        return view('monhoc-add',compact('chuyennganh'));
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
            'mamon'=>'required|min:2|max:10|unique:monhoc,mamon',
            'tenmon'=>'required|min:2|max:100|unique:monhoc,tenmon',
            'sotinchi'=>'required|numeric',
            'heso'=>'required|numeric',

        ]);
        $monhoc=new MonHoc();
        $monhoc->mamon=$request->mamon;
        $monhoc->tenmon=$request->tenmon;
        $monhoc->tenmon_slug=str_slug($request->tenmon);
        $monhoc->sotinchi=$request->sotinchi;
        $monhoc->heso=$request->heso;
        $monhoc->save();
        if (isset($request->ma_cn)){

            foreach ($request->ma_cn as $cn){
                $cn=ChuyenNganh::find($cn);
                $monhoc->chuyennganh()->attach($cn);
            }
        }
        return response([
            'success'=>'Bạn thêm mới thành công'
        ]);

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
        $monhoc=MonHoc::find($id);

        $chuyennganh=ChuyenNganh::all();
        return view('monhoc-edit',compact('monhoc','chuyennganh'));
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
        $this->validate($request,[
            'mamon'=>'required|min:2|max:10|unique:monhoc,mamon,'.$id.',id',
            'tenmon'=>'required|min:2|max:100|unique:monhoc,tenmon,'.$id.',id',
            'sotinchi'=>'required|numeric',
            'heso'=>'required|numeric',
        ]);
        $monhoc=MonHoc::find($id);
        $monhoc->mamon=$request->mamon;
        $monhoc->tenmon=$request->tenmon;
        $monhoc->tenmon_slug=str_slug($request->tenmon);
        $monhoc->sotinchi=$request->sotinchi;
        $monhoc->heso=$request->heso;
        $monhoc->save();
        if (isset($request->ma_cn)){
            $monhoc->chuyennganh()->detach();
            foreach ($request->ma_cn as $cn){
                $cn=ChuyenNganh::find($cn);
                $monhoc->chuyennganh()->attach($cn);
            }
        }
        return response([
            'success'=>'Bạn đã update thành công'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        monhoc::destroy($id);
        return response([
            'success'=>'Bạn đã delete thành công'
        ]);
    }
    public function getview(){
        return view('monhoc');
    }
}
