<?php

class HomeController
{
    public function index() {
        UserController::mustBeLoggedIn();
        require_once "src/views/home.php";
    }
}