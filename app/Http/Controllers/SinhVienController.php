<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SinhVien;
use Excel;

class SinhVienController extends Controller
{
    public function index(){
        $sinhvien=SinhVien::all();
        return view('sinhvien.index',compact('sinhvien'));
    }
   
}
