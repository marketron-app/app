<?php

namespace App\Services\Template;

use App\Http\Requests\Admin\Template\StoreTemplateRequest;
use App\Http\Requests\Admin\Template\UpdateTemplateImage;
use App\Http\Requests\Admin\Template\UpdateThumbnailImage;
use App\Jobs\ProcessTemplateImage;
use App\Models\Template;
use App\Services\Image\ImageService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class TemplateService
{
    public function __construct(private ImageService $imageService)
    {
    }

    public function index($page = 1, $perPage = 20)
    {
        return Template::query()->paginate($perPage, ['*'], 'page', $page);
    }

    public function storeTemplate(StoreTemplateRequest $request)
    {
        File::ensureDirectoryExists(storage_path('app/original-images'));
        $originalImageFileName = Uuid::uuid4().'.png';
        $originalImage = Storage::putFileAs('original-images', $request->file('image')->path(), $originalImageFileName);
        $screenshotCoordinates = $request->validated('screenshotCoordinates');
        $template = Template::query()->create([
            'identifier' => $request->validated('identifier'),
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'coordinates' => [
                'left-top' => $screenshotCoordinates[0],
                'left-bottom' => $screenshotCoordinates[1],
                'right-bottom' => $screenshotCoordinates[2],
                'right-top' => $screenshotCoordinates[3],
            ],
            'screenshot_width' => $request->validated('screenshotWidth'),
            'screenshot_height' => $request->validated('screenshotHeight'),
            'raw_data' => ['screenshotCoordinates' => $request->validated('screenshotCoordinates'), 'cutoutCoordinates' => $request->validated('cutoutCoordinates')],
            'original_image' => $originalImage,
            'tags' => $request->validated('keywords'),
        ]);

        ProcessTemplateImage::dispatch($template);

        return $template;
    }

    public function updateTemplateImage(Template $template, UpdateTemplateImage $request): Template
    {
        if ($request->hasFile('templateImage')) {
            $originalImageFileName = Uuid::uuid4().'.png';
            Storage::put($originalImageFileName, $request->file('templateImage')->getContent());

            $template->url = $originalImageFileName;
        }

        $template->save();

        return $template;
    }

    public function updateThumbnailImage(Template $template, UpdateThumbnailImage $request): Template
    {
        if ($request->hasFile('thumbnailImage')) {
            $originalImageFileName = Uuid::uuid4().'.png';
            Storage::put($originalImageFileName, $request->file('thumbnailImage')->getContent());

            $template->thumbnail_url = $originalImageFileName;
        }

        $template->save();

        return $template;
    }

    public function rerenderThumbnail(Template $template)
    {
        $preview = $this->imageService->createImage($template->identifier, 'https://www.marketron.app');
        $template->thumbnail_url = $preview->s3_path;
        $template->save();
    }
}
