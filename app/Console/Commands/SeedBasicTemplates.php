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
        $data = json_decode(file_get_contents(storage_path('app/seeders_data/templates.json')), true);
        foreach ($data as $template) {
            $this->line('Inserting ' . $template['identifier'] . ' template');
            Template::query()->updateOrCreate(
                [
                'identifier' => $template['identifier'],
            ],
                $template
            );
            $this->info('Success ✅');
        }

        return Command::SUCCESS;
    }
}
