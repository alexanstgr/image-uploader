<?php

namespace Alexanstgr\ImageUploader;

class ImageUploader
{
    private array $config;

    public function __construct(array $config = [])
    {
        $this->config = array_merge([
            'destination' => 'uploads/',
            'maxSize' => 5 * 1024 * 1024,
            'allowedExtensions' => ['jpg', 'jpeg', 'png', 'webp'],
            'createDirectory' => true,
        ], $config);
    }
}
