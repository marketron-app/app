<?php

namespace App\Services\ImageEngine;

class Template
{
    public function __construct(private Coordinate $leftTop, private Coordinate $leftBottom, private Coordinate $rightBottom, private Coordinate $rightTop, private int $viewportWidth, private int $viewportHeight)
    {
    }

    public function getViewportWidth(): int
    {
        return $this->viewportWidth;
    }

    public function getViewportHeight(): int
    {
        return $this->viewportHeight;
    }

    public function getLeftTop(): Coordinate
    {
        return $this->leftTop;
    }

    public function getLeftBottom(): Coordinate
    {
        return $this->leftBottom;
    }

    public function getRightBottom(): Coordinate
    {
        return $this->rightBottom;
    }

    public function getRightTop(): Coordinate
    {
        return $this->rightTop;
    }
}
