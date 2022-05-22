<?php

const BASE_URL = "http://localhost/financial-management-system";

require_once "src/controllers/Core.php";

require_once "src/Database/Connection.php";

require_once "src/models/User.php";

require_once "src/controllers/LoginController.php";
require_once "src/controllers/CadastroController.php";
require_once "src/controllers/UserController.php";
require_once "src/controllers/HomeController.php";

$core = new Core();
$core->start($_SERVER['REQUEST_URI'], $_GET);