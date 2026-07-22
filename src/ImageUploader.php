<?php

namespace Alexanstgr\ImageUploader;

use Alexanstgr\ImageUploader\Exceptions\UploadException;

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


    public function upload(array $file): UploadedImage
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new UploadException('Upload failed');
        }

        // large size exception
        if ($file['size'] > $this->config['maxSize']) {
            throw new UploadException('File is too large');
        }
        return new UploadedImage(
            $file['name'],
            $file['tmp_name'],
            pathinfo($file['name'], PATHINFO_EXTENSION)
        );
    }
}
