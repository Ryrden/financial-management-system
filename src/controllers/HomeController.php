<?php

class HomeController
{
    public function index() {
        if (!isset($_SESSION))
            session_start();

        if (isset($_SESSION["user"]))
            require_once "src/views/home.php";
        else
            echo "<script>location.href='".BASE_URL."/login"."'</script>";
    }
}