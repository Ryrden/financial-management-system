<?php

use Cloudinary\Configuration\Configuration;

use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Tag\ImageTag;
use Cloudinary\Transformation\Resize;
use Cloudinary\Transformation\Gravity;
use Cloudinary\Transformation\FocusOn;

class Upload
{
    private static $configured = false;

    public function __construct()
    {
        if (!self::$configured) {
            Configuration::instance([
                'cloud' => [
                    'cloud_name' => 'davifelix',
                    'api_key' => $_ENV["CLOUDNARY_API_KEY"],
                    'api_secret' =>  $_ENV['CLOUDNARY_API_SECRET']
                ],
                'url' => [
                    'secure' => true
                ]
            ]);
        }
    }

    public function uploadImage($imageName, $imageSize) {
        try {
            $maxImageSize = 500000;
            if (getimagesize($imageName) && $imageSize < $maxImageSize) {
                $uploader = new UploadApi();
                return $uploader->upload($imageName);
            }
            return false;
        } catch (Exception $e) {
            return false;
        }


    }

    public function getTransformedImage($url) {
        $urlElements = explode("/", $url);
        $tag = end($urlElements);
        $imageTag = new ImageTag($tag);
        return $imageTag
            ->resize(
                Resize::thumbnail()
                    ->width(100)
                    ->height(100)
                    ->gravity(Gravity::focusOn(FocusOn::face()))
            );
    }

}