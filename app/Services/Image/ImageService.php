<?php

namespace App\Services\Image;

use App\Services\ImageEngine\GenerateImageRequest;
use App\Services\ImageEngine\ImageEngineService;
use App\Services\ImageEngine\Template;

class ImageService
{
    public function __construct(private ImageEngineService $imageEngineService){

    }
    public function createImage(string $templateIdentifier, string $url){
        $template = \App\Models\Template::query()->where("identifier", $templateIdentifier)->firstOrFail();
        $generateRequest = new GenerateImageRequest($url, $template->url, \App\Models\Template::convertToTemplate($template));
        return $this->imageEngineService->generateImage($generateRequest);
    }
}
