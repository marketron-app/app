<?php

namespace App\Console\Commands;

use Aws\S3\S3Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class CreateS3Bucket extends Command
{
    const BUCKET_ENV_VARIABLE_NAME = 'AWS_BUCKET';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:s3-bucket
        {--f|force : Skip confirmation if variable already exists}
        {--private : Make S3 bucket private. Some manual configuration is needed}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will create new S3 bucket, which Marketron will use to store generated image.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bucketName = 'marketron-export-'.strtolower(Str::random(12));
        $isPrivate = $this->option('private');
        if (file_exists($path = $this->envPath()) === false) {
            $this->error('Missing .env file. Aborting...');

            return;
        }

        if (! $this->validateAwsCredentials()) {
            $this->error('You must set AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY variables.');

            return;
        }

        if (Str::contains(file_get_contents($path), self::BUCKET_ENV_VARIABLE_NAME) === false) {
            $this->createBucket($bucketName, $isPrivate);
            file_put_contents($path, PHP_EOL.self::BUCKET_ENV_VARIABLE_NAME.'='.$bucketName.PHP_EOL, FILE_APPEND);
        } else {
            if (! $this->askForConfirmation()) {
                $this->comment('Stopped generating bucket.');

                return;
            }
            $this->createBucket($bucketName, $isPrivate);
            // update existing entry
            file_put_contents($path, preg_replace(
                '/('.self::BUCKET_ENV_VARIABLE_NAME.'=.*)+/',
                self::BUCKET_ENV_VARIABLE_NAME.'='.$bucketName, file_get_contents($path)
            ));
        }

        $this->info('Created S3 bucket: '.$bucketName);

        return Command::SUCCESS;
    }

    protected function askForConfirmation()
    {
        return $this->option('force') || $this->confirm('This will override your current "'.self::BUCKET_ENV_VARIABLE_NAME.'" variable. Are you sure you want to replace it?');
    }

    protected function envPath()
    {
        if (method_exists($this->laravel, 'environmentFilePath')) {
            return $this->laravel->environmentFilePath();
        }

        return $this->laravel->basePath('.env');
    }

    private function setToConfig($bucketName)
    {
        Config::set('filesystems.disks.s3.bucket', $bucketName);
    }

    private function validateAwsCredentials()
    {
        return Config::get('filesystems.disks.s3.key') && Config::get('filesystems.disks.s3.secret');
    }

    private function createBucket($bucketName, $isPrivate)
    {
        $acl = $isPrivate ? 'private' : 'public-read';
        $s3Client = new S3Client([
            'region' => Config::get('filesystems.disks.s3.region'),
            'version' => '2006-03-01',
            'credentials' => [
                'key' => Config::get('filesystems.disks.s3.key'),
                'secret' => Config::get('filesystems.disks.s3.secret'),
            ],
        ]);

        return $s3Client->createBucket([
            'Bucket' => $bucketName,
            'ACL' => $acl,
        ]);
    }
}
