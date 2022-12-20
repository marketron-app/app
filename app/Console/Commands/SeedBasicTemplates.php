<?php

namespace App\Console\Commands;

use App\Models\Template;
use Illuminate\Console\Command;

class SeedBasicTemplates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:basic-templates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert some templates into database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line("Inserting android-1 template");
        Template::query()->updateOrCreate(
            [
                "identifier" => "android-1",
            ],
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
        $this->info("Success ✅");

        return Command::SUCCESS;
    }
}
