<?php

class LoginController
{
    public function index() {
        if (!isset($_SESSION))
            session_start();

        if ($_SESSION["user"]["codigo"])
            echo "<script>location.href='".BASE_URL."'</script>";
        else
            require_once "src/views/login.php";
    }
}