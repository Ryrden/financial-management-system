<?php

class DocumentosController
{
    public function index() {
        UserController::mustBeLoggedIn();
        require_once "src/views/documentos.php";
    }

    public function generate() {
        require_once "src/views/extrato.php";
    }

}