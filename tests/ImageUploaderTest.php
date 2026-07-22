<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Alexanstgr\ImageUploader\ImageUploader;
use Alexanstgr\ImageUploader\Exceptions\UploadException;

class ImageUploaderTest extends TestCase
{
    public function test_upload_fails_when_file_has_error(): void
    {
        $this->expectException(UploadException::class);

        $uploader = new ImageUploader();

        $uploader->upload([
            'name' => 'test.jpg',
            'tmp_name' => '/tmp/test.jpg',
            'error' => UPLOAD_ERR_NO_FILE
        ]);
    }


    public function test_upload_returns_uploaded_image(): void
    {
        $uploader = new ImageUploader();

        $result = $uploader->upload([
            'name' => 'photo.jpg',
            'tmp_name' => '/tmp/photo.jpg',
            'error' => UPLOAD_ERR_OK
        ]);

        $this->assertInstanceOf(
            \Alexanstgr\ImageUploader\UploadedImage::class,
            $result
        );
    }
}
