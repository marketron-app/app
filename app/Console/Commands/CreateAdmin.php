<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {--email=} {--password=} {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin user with given credentials';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->option('email');
        $password = $this->option('password');
        $name = $this->option('name');

        if (! $email) {
            $email = $this->ask("Admin's email");
        }
        if (! $password) {
            $password = $this->secret("Password for ${email}");
        }
        if (! $name) {
            $name = $email;
        }

        $this->info("Creating admin with email ${email}...");
        User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);
        $this->info('User created!');

        return Command::SUCCESS;
    }
}
