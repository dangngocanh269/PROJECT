<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    protected $table='sinhvien';
    protected $guarded=[];
    public function bangdiem(){
        return $this->belongsToMany('App\MonHoc','bangdiem','id_sv','id_mh')->withPivot('diemtk');
    }
    public function chuyennganh(){
        return $this->belongsTo('App\ChuyenNganh','cn_id','id');
    }
}
