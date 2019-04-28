<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    protected $table='monhoc';
    protected $guarded=[];
    public function chuyennganh(){
        return $this->belongsToMany('App\ChuyenNganh','cn_mh','ma_mh','ma_cn');
    }


}
