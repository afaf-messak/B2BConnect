<?php

namespace App\Support;

use Illuminate\Filesystem\Filesystem;

class WindowsFilesystem extends Filesystem
{
    /**
     * @param  string  $path
     * @param  string  $content
     * @param  int|null  $mode
     */
    public function replace($path, $content, $mode = null): void
    {
        if (DIRECTORY_SEPARATOR !== '\\') {
            parent::replace($path, $content, $mode);

            return;
        }

        clearstatcache(true, $path);

        $directory = dirname($path);

        if (! is_dir($directory)) {
            $this->makeDirectory($directory, 0755, true);
        }

        $written = @file_put_contents($path, $content, LOCK_EX);

        if ($written === false) {
            $tempPath = tempnam($directory, basename($path));

            if ($tempPath === false) {
                parent::replace($path, $content, $mode);

                return;
            }

            if (! is_null($mode)) {
                @chmod($tempPath, $mode);
            } else {
                @chmod($tempPath, 0777 - umask());
            }

            file_put_contents($tempPath, $content);

            if (is_file($path)) {
                @unlink($path);
            }

            if (! @rename($tempPath, $path)) {
                copy($tempPath, $path);
                @unlink($tempPath);
            }
        }

        if (! is_null($mode)) {
            @chmod($path, $mode);
        }
    }
}
