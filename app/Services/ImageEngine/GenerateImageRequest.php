<?php

namespace App\Services\ImageEngine;

class GenerateImageRequest
{
    public function __construct(private string $url, private string $templateImageUrl, private Template $template){

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


}
