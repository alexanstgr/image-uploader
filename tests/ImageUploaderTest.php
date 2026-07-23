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
            'error' => UPLOAD_ERR_OK,
            'size' => 500
        ]);

        $this->assertInstanceOf(
            \Alexanstgr\ImageUploader\UploadedImage::class,
            $result
        );
    }



    public function test_upload_fails_when_file_is_too_large(): void
    {
        $uploader = new ImageUploader([
            'maxSize' => 1000
        ]);

        $this->expectException(UploadException::class);

        $uploader->upload([
            'name' => 'large-image.jpg',
            'tmp_name' => '/tmp/large-image.jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => 5000
        ]);
    }




    public function test_upload_fails_when_extension_is_not_allowed(): void
    {
        $uploader = new ImageUploader();

        $this->expectException(UploadException::class);

        $uploader->upload([
            'name' => 'inkscape.exe',
            'tmp_name' => '/tmp/inkscape.exe',
            'error' => UPLOAD_ERR_OK,
            'size' => 500,
        ]);
    }
}
