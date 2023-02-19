<?php

namespace App\Services\ImageEngine;

class GenerateImageRequest
{
    public function __construct(private string $url, private string $templateImageUrl, private Template $template)
    {
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTemplateImageUrl(): string
    {
        return $this->templateImageUrl;
    }

    public function getTemplate(): Template
    {
        return $this->template;
    }

    public function getFormatedCoordinates(): array
    {
        return [
            [
                'x' => intval($this->getTemplate()->getLeftTop()->x),
                'y' => intval($this->getTemplate()->getLeftTop()->y),
            ],
            [
                'x' => intval($this->getTemplate()->getLeftBottom()->x),
                'y' => intval($this->getTemplate()->getLeftBottom()->y),
            ],
            [
                'x' => intval($this->getTemplate()->getRightBottom()->x),
                'y' => intval($this->getTemplate()->getRightBottom()->y),
            ],
            [
                'x' => intval($this->getTemplate()->getRightTop()->x),
                'y' => intval($this->getTemplate()->getRightTop()->y),
            ],
        ];
    }
}
