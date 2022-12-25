<?php

namespace App\Services\ImageEngine;

class GenerateImageRequest
{
    public function __construct(private string $url, private string $templateImageUrl, private Template $template)
    {
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getTemplateImageUrl(): string
    {
        return $this->templateImageUrl;
    }

    /**
     * @return Template
     */
    public function getTemplate(): Template
    {
        return $this->template;
    }

    public function getFormatedCoordinates(): array
    {
        return [
            [
                'x' => $this->getTemplate()->getLeftTop()->x,
                'y' => $this->getTemplate()->getLeftTop()->x,
            ],
            [
                'x' => $this->getTemplate()->getLeftBottom()->x,
                'y' => $this->getTemplate()->getLeftBottom()->x,
            ],
            [
                'x' => $this->getTemplate()->getRightBottom()->x,
                'y' => $this->getTemplate()->getRightBottom()->x,
            ],
            [
                'x' => $this->getTemplate()->getRightTop()->x,
                'y' => $this->getTemplate()->getRightTop()->x,
            ],
        ];
    }
}
