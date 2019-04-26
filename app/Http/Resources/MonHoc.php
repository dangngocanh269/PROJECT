<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MonHoc extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'mamon'=>$this->mamon,
            'tenmon'=>$this->tenmon,
            'sotinchi'=>$this->sotinchi,
            'heso'=>$this->heso
        ];
    }
}
