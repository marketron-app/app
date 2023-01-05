<?php

namespace App\Services\ImageEngine;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class ImageEngineService
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl(config('image-engine.url'))->timeout(30)->acceptJson();
    }

    public function generateImage(GenerateImageRequest $request)
    {
        $query = http_build_query([
            'url' => $request->getUrl(),
            'templateImage' => $request->getTemplateImageUrl(),
            'coordinates' => $request->getFormatedCoordinates(),
            'viewportWidth' => $request->getTemplate()->getViewportWidth(),
            'viewportHeight' => $request->getTemplate()->getViewportHeight(),
        ]);

        return $this->client->get('/image', $query)->json();
    }
}
