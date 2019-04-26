<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChuyenNganh extends JsonResource
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
            'macn'=>$this->macn,
            'tencn'=>$this->tencn,
            'tenkhoa'=>$this->khoa->tenkhoa,
        ];
    }
}
