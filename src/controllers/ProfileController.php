<?php

class ProfileController
{
    public function index() {
        UserController::mustBeLoggedIn();
        require_once "src/views/profile.php";
    }
}