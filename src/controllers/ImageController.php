<?php

class ImageController
{
    public function upload() {
        UserController::mustBeLoggedIn();
        $imageName= $_FILES["image"]["tmp_name"];
        $upload = new Upload();
        var_dump($upload->uploadImage($imageName)["url"]);
    }
}