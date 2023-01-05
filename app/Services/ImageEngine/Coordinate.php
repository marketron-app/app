<?php

namespace App\Services\ImageEngine;

class Coordinate
{
    public function __construct(public int|float $x, public int|float $y)
    {
    }
}
