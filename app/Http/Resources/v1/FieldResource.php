<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class FieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        return [
            'status' => $this->when($request->method() !== 'GET','success'),
            'message' => $this->when($request->method() !== 'GET','You have successfully created '. $this->name .' field with the type of '. $this->type.'.'),
            'field' => [
                'field_name' => $this->resource->name,
                'label' => $this->resource->label,
                'type' => $this->resource->type,
                'isMadeByYou' => $this->when($request->method() === 'GET',$this->resource->user_id === auth()->id() ? 'true': 'false'),
                'created_at' => $this->resource->created_at,
            ]

        ];
    }
}
