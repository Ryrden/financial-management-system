<?php

require_once "src/controllers/Core.php";
require_once "src/controllers/LoginController.php";
require_once "src/controllers/CadastroController.php";

$core = new Core();
$core->start($_SERVER['REQUEST_URI'], $_GET);