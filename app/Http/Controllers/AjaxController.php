<?php

namespace App\Http\Controllers;

use App\ChuyenNganh;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function changekhoa($id){
        $chuyennganh=ChuyenNganh::where('khoa_id','=',$id)->get();
        return $chuyennganh;
    }
    public function changecn($id){
        $chuyennganh=ChuyenNganh::find($id);
        return $chuyennganh->monhoc;
    }
}
