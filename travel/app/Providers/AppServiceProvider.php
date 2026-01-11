<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use AsyncAws\S3\S3Client;
use League\Flysystem\AsyncAwsS3\AsyncAwsS3Adapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Storage::extend('s3', function ($app, $config) {
            $client = new S3Client([
                'region' => $config['region'],
                'accessKeyId' => $config['key'],
                'accessKeySecret' => $config['secret'],
                'endpoint' => $config['endpoint'] ?? null,
                'pathStyleEndpoint' => $config['use_path_style_endpoint'] ?? false,
            ]);

            $adapter = new AsyncAwsS3Adapter($client, $config['bucket']);

            return new \App\Filesystem\AsyncAwsFilesystemAdapter(
                new Filesystem($adapter, ['url' => $config['url']]),
                $adapter,
                $config
            );
        });
    }
}
