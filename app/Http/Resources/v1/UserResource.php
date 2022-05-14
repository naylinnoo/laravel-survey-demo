<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user' => [
                'id' => $this->resource->id,
                'name' => $this->resource->name,
                'email' => $this->resource->email
            ],
            'token'=> $this->resource->createToken('User-Token')->plainTextToken
        ];
    }
}
