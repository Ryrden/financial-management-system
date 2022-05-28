<?php

require "vendor/autoload.php";

try {
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
} catch (Exception $e) {

}

define('BASE_URL', $_ENV['BASE_URL']);

require_once "src/controllers/Core.php";

require_once "src/Database/Connection.php";

require_once "src/models/User.php";
require_once "src/models/Transaction.php";
require_once "src/models/Charts.php";
require_once "src/models/Questionario.php";
require_once "src/models/Profile.php";

require_once "src/models/Charts.php";
require_once "src/models/Questionario.php";
require_once "src/models/Profile.php";

require_once "src/controllers/LoginController.php";
require_once "src/controllers/CadastroController.php";
require_once "src/controllers/UserController.php";
require_once "src/controllers/HomeController.php";
require_once "src/controllers/TransactionController.php";
require_once "src/controllers/ImageController.php";
require_once "src/controllers/EditprofileController.php";

require_once "src/controllers/DocumentosController.php";
require_once "src/controllers/QuestionarioController.php";
require_once "src/controllers/ProfileController.php";

require_once "src/utils/Format.php";

require_once "src/services/Upload.php";


$core = new Core();
$core->start($_SERVER['REQUEST_URI'], $_GET);