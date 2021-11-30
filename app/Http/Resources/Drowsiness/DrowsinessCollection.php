<?php

namespace App\Http\Resources\Drowsiness;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DrowsinessCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user'=>new UserResource($this->user),
            'blinks'=>$this->blinks,
            'perclos'=>$this->perclos
        ];
    }
}
