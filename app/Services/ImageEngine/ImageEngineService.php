<?php

namespace App\Services\ImageEngine;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class ImageEngineService
{

    private PendingRequest $client;
    public function __construct(){
        $this->client = Http::baseUrl(config("image-engine.url"));
    }

    public function generateImage(GenerateImageRequest $request){
        $query = http_build_query([
            "url" => $request->getUrl(),
            "templateImage" => $request->getTemplateImageUrl(),
            "coordinates" => [
                [
                    "x" => $request->getTemplate()->getLeftTop()->x,
                    "y" => $request->getTemplate()->getLeftTop()->x
                ],
                [
                    "x" => $request->getTemplate()->getLeftBottom()->x,
                    "y" => $request->getTemplate()->getLeftBottom()->x
                ],
                [
                    "x" => $request->getTemplate()->getRightBottom()->x,
                    "y" => $request->getTemplate()->getRightBottom()->x
                ],
                [
                    "x" => $request->getTemplate()->getRightTop()->x,
                    "y" => $request->getTemplate()->getRightTop()->x
                ]
            ]
        ]);
        return $this->client->get("/image", $query)->json();
    }
}
