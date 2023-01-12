<?php

namespace App\Models;

use App\Services\ImageEngine\Coordinate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'coordinates' => 'array',
        'raw_data' => 'array',
        'tags' => 'array',
        'published_at' => 'datetime',
    ];

    public static function convertToTemplate(Template $template): \App\Services\ImageEngine\Template
    {
        $coordinates = $template->coordinates;

        return new \App\Services\ImageEngine\Template(
            new Coordinate($coordinates['left-top']['x'], $coordinates['left-top']['y']),
            new Coordinate($coordinates['left-bottom']['x'], $coordinates['left-bottom']['y']),
            new Coordinate($coordinates['right-bottom']['x'], $coordinates['right-bottom']['y']),
            new Coordinate($coordinates['right-top']['x'], $coordinates['right-top']['y']),
            $template->screenshot_width,
            $template->screenshot_height
        );
    }

    public function scopePublished($query){
        $query->whereNotNull("published_at");
    }
}
