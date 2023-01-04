<?php

namespace App\Services\Template;

use Imagick;

class TemplateImageProcessor
{
    const MAX_WIDTH = 1000;
    const MAX_HEIGHT = 1000;
    /**
     * @throws \ImagickException
     */
    public function cutoutImage(string $rawImagePath, array $coordinates, string $templateImagePath)
    {
        $image = new Imagick($rawImagePath);
        if ($image->getImageAlphaChannel() == Imagick::ALPHACHANNEL_UNDEFINED) {
            $image->setImageAlphaChannel(Imagick::ALPHACHANNEL_TRANSPARENT);
        }
        $image->setImageFormat('png');

        $mask = $this->generateMask($coordinates, $image->getImageWidth(), $image->getImageHeight());

        $image->compositeImage($mask, Imagick::COMPOSITE_COPYOPACITY, 0, 0, Imagick::CHANNEL_ALPHA);
        $image->resizeImage(self::MAX_HEIGHT, self::MAX_WIDTH, Imagick::FILTER_LANCZOS, 0, true);
        $image->writeImage($templateImagePath);

        return $image;
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
}
