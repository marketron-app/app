<?php

namespace App\Jobs;

use App\Models\Template;
use App\Models\TemplateProcessingEvent;
use App\Services\Image\ImageService;
use App\Services\Template\TemplateImageProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class ProcessTemplateImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const STATUS_PROCESSING = 'processing';

    const STATUS_ERROR = 'error';

    const STATUS_SUCCESS = 'success';

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
    public function handle(TemplateImageProcessor $imageProcessor, ImageService $imageService)
    {
        $template = $this->template;
        $this->addProcessingEvent('Started processing template image', self::STATUS_PROCESSING);

        $newImagePath = Uuid::uuid4().'.png';
        $coordinates = $template->raw_data['cutoutCoordinates'];
        $this->addProcessingEvent("Generated image name: ${newImagePath}", self::STATUS_PROCESSING);

        try {
            $this->addProcessingEvent('Getting original image', self::STATUS_PROCESSING);
            $contents = Storage::get($template->original_image);
            $this->addProcessingEvent('Cutting out coordinates from original image and compressing', self::STATUS_PROCESSING);
            $img = $imageProcessor->cutoutImage($contents, $coordinates, $newImagePath, $this->template);

            $this->template->url = $newImagePath;
            $this->template->save();

            $this->addProcessingEvent('Generating thumbnail image', self::STATUS_PROCESSING);
            $preview = $imageService->createImage($template->identifier, 'https://www.marketron.app');

            $this->template->thumbnail_url = $preview->s3_path;
            $this->template->save();
            $this->addProcessingEvent('Template finished processing', self::STATUS_SUCCESS);
        } catch (\Exception $exception) {
            $this->addProcessingEvent('Error: '.$exception->getMessage(), self::STATUS_ERROR);
        }
    }

    private function addProcessingEvent($message, $status)
    {
        return TemplateProcessingEvent::query()->create([
            'template_id' => $this->template->id,
            'message' => $message,
            'status' => $status,
            'metadata' => [
                'job_id' => $this->job->getJobId(),
                'connection_name' => $this->job->getConnectionName(),
                'name' => $this->job->getName(),
            ],
        ]);
    }
}
