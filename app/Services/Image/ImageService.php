<?php

namespace App\Services\Image;

use App\Models\Image;
use App\Models\Template;
use App\Services\ImageEngine\GenerateImageRequest;
use App\Services\ImageEngine\ImageEngineService;
use Illuminate\Support\Facades\Auth;

class ImageService
{
    public function __construct(private ImageEngineService $imageEngineService)
    {
    }
    public function createImage(string $templateIdentifier, string $url)
    {
        $template = Template::query()->where('identifier', $templateIdentifier)->firstOrFail();
        $generateRequest = new GenerateImageRequest($url, $template->url, Template::convertToTemplate($template));
        $response = $this->imageEngineService->generateImage($generateRequest);

        return Image::query()->create([
            'url' => $url,
            'template_id' => $template->id,
            's3_path' => $response['filename'],
            'user_id' => Auth::user()?->getAuthIdentifier(),
            'metadata' => [],
        ]);
    }
}
