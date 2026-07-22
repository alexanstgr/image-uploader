<?php

namespace Alexanstgr\ImageUploader;

class UploadedImage
{
    public function __construct(
        private string $filename,
        private string $path,
        private string $extension
    ) {}

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }
}
