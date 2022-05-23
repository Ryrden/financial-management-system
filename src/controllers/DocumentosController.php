<?php

class DocumentosController
{
    public function index() {
        if (!isset($_SESSION))
            session_start();

        if (isset($_SESSION["user"]))
            require_once "src/views/documentos.php";
        else
            echo "<script>location.href='".BASE_URL."/login"."'</script>";
    }
}