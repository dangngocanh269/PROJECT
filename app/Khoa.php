<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    protected $table='khoa';
    protected $guarded=[];
    public function giaovien(){
        return $this->belongsTo('App\GiaoVien','gv_id','id');
    }
    public function chuyennganh(){
        return $this->hasMany('App\ChuyenNganh','khoa_id','id');
    }

}
