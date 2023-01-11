<?php

namespace App\Services\Template;

use Illuminate\Support\Facades\Storage;
use Imagick;

class TemplateImageProcessor
{
    const MAX_WIDTH = 1000;

    const MAX_HEIGHT = 1000;

    /**
     * @throws \ImagickException
     */
    public function cutoutImage(string $rawImagePath, array $coordinates, string $templateImagePath, \App\Models\Template $template)
    {
        $image = new Imagick($rawImagePath);

        if ($image->getImageAlphaChannel() == Imagick::ALPHACHANNEL_UNDEFINED) {
            $image->setImageAlphaChannel(Imagick::ALPHACHANNEL_TRANSPARENT);
        }
        $image->setImageFormat('png');

        $mask = $this->generateMask($coordinates, $image->getImageWidth(), $image->getImageHeight());

        $image->compositeImage($mask, Imagick::COMPOSITE_COPYOPACITY, 0, 0, Imagick::CHANNEL_ALPHA);

        $image = $this->resizeImage($image, $template);
        $this->uploadAndDeleteImage($templateImagePath, $image);

        return $image;
    }

    /**
     * @throws \ImagickException
     */
    public function resizeImage(Imagick $image, \App\Models\Template $template): Imagick
    {
        $originalWidth = $image->getImageWidth();
        $originalHeight = $image->getImageHeight();

        $image->resizeImage(self::MAX_HEIGHT, self::MAX_WIDTH, Imagick::FILTER_POINT, 0, true);
        $newWidth = $image->getImageWidth();
        $newHeight = $image->getImageHeight();

        $xScale = $newWidth / $originalWidth;
        $yScale = $newHeight / $originalHeight;
        $this->scaleCoordinates($xScale, $yScale, $template);

        return $image;
    }

    public function uploadAndDeleteImage(string $templateImagePath, Imagick $imagick): void
    {
        Storage::disk('s3')->put($templateImagePath, $imagick);
    }

    public function generateMask(array $coordinates, int $width, int $height): Imagick
    {
        $draw = new \ImagickDraw();

        $draw->setFillColor('black');

        $draw->polygon($coordinates);

        $image = new \Imagick();

        $image->newImage($width, $height, 'white', 'png');
        $image->drawImage($draw);
        $image->transparentPaintImage('black', 0.0, 0, false);

        return $image;
    }

    /**
     * This method scales the coordinates of the screenshot image based on scaling factor of the image
     *
     * @return void
     */
    public function scaleCoordinates($xScale, $yScale, \App\Models\Template $template)
    {
        $coordinates = $template->coordinates;
        $coordinates = collect($coordinates)->map(fn ($el) => ['x' => $el['x'] * $xScale, 'y' => $el['y'] * $yScale]);
        $template->coordinates = $coordinates;
        $template->save();
    }
}
