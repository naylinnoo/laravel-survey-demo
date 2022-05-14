<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class TemplateResource extends JsonResource
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
            'id' => $this->resource->id,
            'survey_name' => $this->resource->name,
            'link' => $this->resource->link,
            'created_at' => $this->resource->created_at,
            'fields' => FieldResource::collection($this->whenLoaded('fields')),
        ];
    }
}
