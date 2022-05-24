<?php

class DocumentosController
{
    public function index() {
        UserController::mustBeLoggedIn();
        require_once "src/views/documentos.php";
    }
}