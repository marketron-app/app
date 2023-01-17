<?php

namespace App\Services\Template;

use App\Http\Requests\Admin\Template\StoreTemplateRequest;
use App\Http\Requests\Admin\Template\UpdateTemplateImage;
use App\Jobs\ProcessTemplateImage;
use App\Models\Template;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class TemplateService
{
    public function index($page = 1, $perPage = 20)
    {
        return Template::query()->paginate($perPage, ['*'], 'page', $page);
    }

    public function storeTemplate(StoreTemplateRequest $request)
    {
        $originalImageFileName = Uuid::uuid4().'.png';
        $originalImage = $request->file('image')->storeAs('original-images', $originalImageFileName);
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
        if($request->hasFile("templateImage")){
            $originalImageFileName = Uuid::uuid4().'.png';
            Storage::disk('s3')->put($originalImageFileName, $request->file("templateImage")->getContent());

            $template->url = $originalImageFileName;
        }

        $template->save();
        return $template;
    }
}
