<?php

namespace App\Http\Resources\Admin\Template;

use Illuminate\Http\Resources\Json\JsonResource;

class TemplateProcessingEventResource extends JsonResource
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
            'createdAt' => $this->created_at,
            'message' => $this->message,
            'status' => $this->status,
        ];
    }
}
