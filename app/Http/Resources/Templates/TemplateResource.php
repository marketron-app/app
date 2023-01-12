<?php

namespace App\Http\Resources\Templates;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'thumbnailImage' => Storage::disk('s3')->temporaryUrl($this->thumbnail_url, Carbon::now()->addMinutes(10)),
        ];
    }
}
