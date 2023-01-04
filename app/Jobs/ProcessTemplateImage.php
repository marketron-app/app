<?php

namespace App\Jobs;

use App\Models\Template;
use App\Services\Template\TemplateImageProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;

class ProcessTemplateImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public Template $template)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     *
     * @throws \ImagickException
     */
    public function handle(TemplateImageProcessor $imageProcessor)
    {
        File::ensureDirectoryExists(storage_path('app/cutout-images'));
        $template = $this->template;

        $newImagePath = storage_path('app/cutout-images/'.Uuid::uuid4().'.png');
        $coordinates = $template->raw_data['cutoutCoordinates'];

        $imagePath = storage_path('app/'.$template->original_image);
        $img = $imageProcessor->cutoutImage($imagePath, $coordinates, $newImagePath);

        $this->template->url = $newImagePath;
        $this->template->save();
    }
}
