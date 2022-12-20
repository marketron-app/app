<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\StoreImageRequest;
use App\Services\Image\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __construct(private ImageService $imageService){

    }
    public function store(StoreImageRequest $request){
        $image = $this->imageService->createImage(
            $request->validated("template"),
            $request->validated("url"),
        );

        return $image;
    }
}
