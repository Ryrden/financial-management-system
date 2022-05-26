<?php

class EditprofileController
{
    public function index() {
        UserController::mustBeLoggedIn();
        require_once "src/views/editprofile.php";
    }
}