<?php

namespace App\Http\Resources\Admin\Templates;

use Illuminate\Http\Resources\Json\JsonResource;

class LiteTemplateResource extends JsonResource
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
            'id' => $this->id,
            'identifier' => $this->identifier,
            'title' => $this->title,
            'description' => $this->description,
            'tags' => $this->tags,
            'createdAt' => $this->created_at,
            "publishedAt" => $this->published_at
        ];
    }
}
