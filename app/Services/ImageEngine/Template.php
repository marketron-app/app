<?php

namespace App\Services\ImageEngine;

class Template
{
    public function __construct(private Coordinate $leftTop, private Coordinate $leftBottom, private Coordinate $rightBottom, private Coordinate $rightTop){

    }

    /**
     * @return Coordinate
     */
    public function getLeftTop(): Coordinate
    {
        return $this->leftTop;
    }

    /**
     * @return Coordinate
     */
    public function getLeftBottom(): Coordinate
    {
        return $this->leftBottom;
    }

    /**
     * @return Coordinate
     */
    public function getRightBottom(): Coordinate
    {
        return $this->rightBottom;
    }

    /**
     * @return Coordinate
     */
    public function getRightTop(): Coordinate
    {
        return $this->rightTop;
    }
}
