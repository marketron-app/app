<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\StoreImageRequest;
use App\Http\Resources\Images\ImageResource;
use App\Services\Image\ImageService;

class ImageController extends Controller
{
    public function __construct(private ImageService $imageService){

    }
    public function store(StoreImageRequest $request): ImageResource
    {
        $image = $this->imageService->createImage(
            $request->validated("template"),
            $request->validated("url"),
        );

        return ImageResource::make($image);
    }
}
