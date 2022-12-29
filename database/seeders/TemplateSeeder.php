<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Template::create([
            'identifier' => 'template-1',
            'title' => 'Template 1',
            'description' => 'Lorem ipsum dolor sit amet',
            'url' => 'http://example.com/template-1',
            'thumbnail_url' => 'http://example.com/template-1-thumbnail.jpg',
            'coordinates' => [
                'left-top' => ['x' => 985, 'y' => 408],
                'left-bottom' => ['x' => 64, 'y' => 1150],
                'right-bottom' => ['x' => 448, 'y' => 1586],
                'right-top' => ['x' => 1367, 'y' => 805],
            ],
            'screenshot_width' => 1920,
            'screenshot_height' => 1080,
        ]);

        Template::create([
            'identifier' => 'template-2',
            'title' => 'Template 2',
            'description' => 'Consectetur adipiscing elit',
            'url' => 'http://example.com/template-2',
            'thumbnail_url' => 'http://example.com/template-2-thumbnail.jpg',
            'coordinates' => [
                'left-top' => ['x' => 985, 'y' => 408],
                'left-bottom' => ['x' => 64, 'y' => 1150],
                'right-bottom' => ['x' => 448, 'y' => 1586],
                'right-top' => ['x' => 1367, 'y' => 805],
            ],
            'screenshot_width' => 1920,
            'screenshot_height' => 1080,
        ]);
    }
}
