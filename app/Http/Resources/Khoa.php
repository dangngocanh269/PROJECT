<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Khoa extends JsonResource
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
            'tenkhoa'=>$this->tenkhoa,
            'tenkhoa_slug'=>$this->tenkhoa_slug,
            'truongkhoa'=>$this->giaovien->hoten,
        ];
    }
}
