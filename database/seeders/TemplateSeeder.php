<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Template::query()->create(
            [
                "url" => "https://marketron-templates.s3.eu-central-1.amazonaws.com/android-1.png",
                "thumbnail_url" => "https://marketron-templates.s3.eu-central-1.amazonaws.com/android-1.png",
                "identifier" => "android-1",
                "title" => "Android 1",
                "description" => "Template with Android device.",
                "coordinates" => [
                    "left-top" => [
                        "x" => 985,
                        "y" => 408
                    ],
                    "left-bottom" => [
                        "x" => 64,
                        "y" => 1150
                    ],
                    "right-bottom" => [
                        "x" => 448,
                        "y" => 1586
                    ],
                    "right-top" => [
                        "x" => 1367,
                        "y" => 805
                    ]
                ],
                "screenshot_width" => 375,
                "screenshot_height" => 812
            ]
        );
    }
}
