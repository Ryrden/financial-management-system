<?php

class LoginController
{
    public function index() {
        if (!isset($_SESSION))
            session_start();

        if (isset($_SESSION["user"]))
            echo "<script>location.href='".BASE_URL."'</script>";
        else
            require_once "src/views/login.php";
    }
}