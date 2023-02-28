<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\StoreImageRequest;
use App\Http\Resources\Images\ImageResource;
use App\Http\Resources\Templates\TemplateResource;
use App\Models\Image;
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
        $selectedTemplate = Template::query()->where('identifier', $request->query('identifier'))->first();
        $otherTemplates = Template::query()->published()->whereNot('id', $selectedTemplate?->id)->inRandomOrder()->take(10)->paginate();

        return Inertia::render('Image/Index', [
            'prefilledTemplate' => $selectedTemplate ? TemplateResource::make($selectedTemplate) : null,
            'otherTemplates' => TemplateResource::collection($otherTemplates),
        ]);
    }

    public function indexMore(Request $request){
        $excludedTemplates = $request->get("excluded", []);
        $templates = Template::query()->whereNotIn("identifier", $excludedTemplates)->paginate();

        return TemplateResource::collection($templates);
    }

    public function store(StoreImageRequest $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        try {
            $image = $this->imageService->createImage(
                (string) $request->validated('template'),
                (string) $request->validated('url'),
            );

            return redirect(route('images.show', ['image' => $image]));
        } catch (\Exception $exception) {
            $errors = ['generate' => 'There was a problem generating your image. Check your URL and try again.'];

            return redirect(route('images.index'))->withErrors($errors);
        }
    }

    public function show(Image $image)
    {
        return Inertia::render('Image/Show', [
            'image' => ImageResource::make($image),
        ]);
    }
}
