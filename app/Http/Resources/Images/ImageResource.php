<?php

namespace App\Http\Resources\Images;

use App\Http\Resources\Templates\TemplateResource;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     *
     * @extends JsonResource<Template>
     */
    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'template' => TemplateResource::make($this->template),
            'path' => Storage::disk('s3')->temporaryUrl($this->s3_path, Carbon::now()->addMinutes(10)),
            'createdAt' => $this->created_at,
        ];
    }
}
