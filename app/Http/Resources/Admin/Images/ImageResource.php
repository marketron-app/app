<?php

namespace App\Http\Resources\Admin\Images;

use App\Http\Resources\Admin\Users\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'url' => $this->url,
            'user' => UserResource::make($this->user) ?? null,
            'createdAt' => $this->created_at,
        ];
    }
}
