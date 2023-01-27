<?php

namespace App\Http\Resources\Admin\Templates;

use App\Http\Resources\Admin\Template\TemplateProcessingEventResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TemplateResource extends JsonResource
{
    public static $wrap = null;

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
            'title' => $this->title,
            'identifier' => $this->identifier,
            'thumbnailImage' => $this->thumbnail_url ? Storage::disk('s3')->temporaryUrl($this->thumbnail_url, Carbon::now()->addMinutes(10)) : null,
            'templateUrl' => $this->url ? Storage::disk('s3')->temporaryUrl($this->url, Carbon::now()->addMinutes(10)) : null ,
            'publishedAt' => $this->published_at,
            'screenshotWidth' => $this->screenshot_width,
            'screenshotHeight' => $this->screenshot_height,
            'screenshotCoordinates' => $this->coordinates,
            'rawData' => $this->raw_data,
            'tags' => $this->tags,
            "events" => TemplateProcessingEventResource::collection($this->processingEvents)
        ];
    }
}
