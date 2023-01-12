<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\StoreImageRequest;
use App\Http\Resources\Images\ImageResource;
use App\Http\Resources\Templates\TemplateResource;
use App\Models\Template;
use App\Services\Image\ImageService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ImageController extends Controller
{
    public function __construct(private ImageService $imageService)
    {
    }
    public function index(Request $request)
    {
        $selectedTemplate = Template::query()->where("identifier", $request->query("identifier"))->first();
        $otherTemplates = Template::query()->published()->whereNot("id", $selectedTemplate?->id)->inRandomOrder()->take(10)->get();

        return Inertia::render("Image/Index", [
            "selectedTemplate" => TemplateResource::make($selectedTemplate) ?? null,
            "otherTemplates" => TemplateResource::collection($otherTemplates)
        ]);
    }


    public function store(StoreImageRequest $request): ImageResource
    {
        $image = $this->imageService->createImage(
            (string) $request->validated('template'),
            (string) $request->validated('url'),
        );

        return ImageResource::make($image);
    }

    public function show($id)
    {
        //
    }


}
