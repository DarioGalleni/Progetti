<?php

namespace App\Filesystem;

use Illuminate\Filesystem\FilesystemAdapter;

class AsyncAwsFilesystemAdapter extends FilesystemAdapter
{
    /**
     * Get the URL for the file at the given path.
     *
     * @param  string  $path
     * @return string
     *
     * @throws \RuntimeException
     */
    public function url($path)
    {
        if (isset($this->config['url'])) {
            return $this->concatPathToUrl($this->config['url'], $path);
        }

        return parent::url($path);
    }
}
