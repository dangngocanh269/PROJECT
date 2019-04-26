<?php

namespace App\Http\Controllers;

use App\GiaoVien;
use Illuminate\Http\Request;
use App\Khoa;
use App\Http\Resources\Khoa as KhoaResource;

class KhoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return KhoaResource::collection(Khoa::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $giaovien=GiaoVien::all();
//        dd($giaovien);
        return view('khoa-add',compact('giaovien'));
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
            'tenkhoa' => 'required|unique:khoa,tenkhoa|min:3|max:100'
        ]);
        $khoa=new Khoa();
        $khoa->tenkhoa=$request->tenkhoa;
        $khoa->tenkhoa_slug=str_slug($request->tenkhoa);
        $khoa->gv_id=$request->ma_gv;
        $khoa->save();
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
        $giaovien=GiaoVien::all();
        $khoa=Khoa::find($id);
        return view('khoa-edit',compact('khoa','giaovien'));
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
            'tenkhoa' => 'required|unique:khoa,tenkhoa,'.$id.',id|min:3|max:100'
        ]);
        $khoa=Khoa::find($id);
        $khoa->tenkhoa=$request->tenkhoa;
        $khoa->tenkhoa_slug=str_slug($request->tenkhoa);
        $khoa->gv_id=$request->ma_gv;
        $khoa->save();
        return response([
            'success'=>'Bạn update thành công'
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
        Khoa::destroy($id);
        return response([
            'success'=>'Bạn update thành công'
        ]);
    }
    public function getview(){
        return view('khoa');
    }
}
