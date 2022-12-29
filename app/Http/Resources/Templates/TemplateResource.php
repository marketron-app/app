<?php

namespace App\Http\Resources\Templates;

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
            'identifier' => $this->identifier,
            'image' => $this->thumbnail_url,
            'description' => $this->description,
            'name' => $this->title,
        ];
    }
}
