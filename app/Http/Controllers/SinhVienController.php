<?php

namespace App\Http\Controllers;

use App\Khoa;
use App\MonHoc;
use Illuminate\Http\Request;
use App\SinhVien;

class SinhVienController extends Controller
{
    public function index(){
        $sinhvien=SinhVien::all();
        return view('sinhvien',compact('sinhvien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $khoa=Khoa::all();
        $chuyennganh=$khoa->first();
        $monhoc=MonHoc::where('cn_id','=',$chuyennganh->id);
        return view('sinhvien-add',compact('khoa','chuyennganh','monhoc'));
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
            'masv'=>'required|min:4|max:10|unique:sinhvien,masv',
            'hoten'=>'required|min:5|max:100',
            'khoahoc'=>'required|min:5|max:100',
            'ngaysinh'=>'required',
            'lophoc'=>'required|min:5|max:100'

        ]);
        $sinhvien=new SinhVien();
        $sinhvien->masv=$request->masv;
        $sinhvien->hoten=$request->hoten;
        $sinhvien->ngaysinh=$request->ngaysinh;
        $sinhvien->khoahoc=$request->khoahoc;
        $sinhvien->cn_id=$request->cn_id;
        $sinhvien->lophoc=$request->lophoc;
        $sinhvien->save();
        if ($request->check=="on"){
            if ($request->mh_id){
                foreach ($request->mh_id as $idmh){
                    $so=rand(50,100)/10;
                    $monhoc=MonHoc::find($idmh);
                    $sinhvien->bangdiem()->attach($monhoc,array('diemtk'=>$so));
                }
            }
        }else{
            if ($request->mh_id){
                foreach ($request->mh_id as $idmh){
                    $so=rand(30,100)/10;
                    if ($so >=4.6 && $so<5){
                        $so= 5;
                    }
                    $monhoc=MonHoc::find($idmh);
                    $sinhvien->bangdiem()->attach($monhoc,array('diemtk'=>$so));
                }
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SinhVien::destroy($id);
        return response([
            'success'=>'Bạn đã delete thành công'
        ]);
    }
    public function getview(){
        return view('monhoc');
    }
    public function tracuusv(Request $request){
        $sinhvien=SinhVien::where($request->column,'=',$request->tukhoa)->first();
        if (empty($sinhvien)){
            return 'Không tìm thấy sinh viên có mã này';
        }else{
            if ($sinhvien->bangdiem->isEmpty()){
                $b=[];
                $c=[];
                return view('data-searchsv',compact('sinhvien','b','c'));
            }else{
                $a=$sinhvien->bangdiem->chunk(round(count($sinhvien->bangdiem)/2));
                $b=$a[0];
                $c=$a[1];
                $tongtinchi=$sinhvien->bangdiem->where('pivot.diemtk','>=','5')->where('mamon','<>','GDQP')->where('mamon','<>','GDTC')->sum('sotinchi');
                $diemtb=$sinhvien->bangdiem->where('mamon','<>','GDQP')->where('mamon','<>','GDTC')->sum('pivot.diemtk')/count($sinhvien->bangdiem);

                return view('data-searchsv',compact('sinhvien','b','c','tongtinchi','diemtb'));
            }

        }


    }
}
