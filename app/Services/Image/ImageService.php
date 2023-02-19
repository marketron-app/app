<?php

namespace App\Services\Image;

use App\Models\Image;
use App\Models\Template;
use App\Models\User;
use App\Services\ImageEngine\GenerateImageRequest;
use App\Services\ImageEngine\ImageEngineService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function __construct(private ImageEngineService $imageEngineService)
    {
    }

    public function createImage(string $templateIdentifier, string $url)
    {
        $template = Template::query()->where('identifier', $templateIdentifier)->firstOrFail();
        $imageSignedUrl = Storage::temporaryUrl($template->url, Carbon::now()->addMinutes(5));
        $generateRequest = new GenerateImageRequest($url, $imageSignedUrl, Template::convertToTemplate($template));
        $response = $this->imageEngineService->generateImage($generateRequest);

        return Image::query()->create([
            'url' => $url,
            'template_id' => $template->id,
            's3_path' => $response['body']['filename'],
            'user_id' => Auth::user()?->getAuthIdentifier(),
            'metadata' => [
                'metrics' => $response['metrics'],
            ],
        ]);
    }

    public function getUserImages(User $user)
    {
        return Image::query()->where('user_id', $user->id);
    }
}
