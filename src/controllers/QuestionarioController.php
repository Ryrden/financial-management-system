<?php

class QuestionarioController
{
    private static $id;

    public function index($id) {
        UserController::mustBeLoggedIn();
        self::$id = $id ? : 1;
        require_once "src/views/questionario.php";
    }

    public static function listQuestions() {
        $questionaryModel = new Questionario();
        return $questionaryModel->getQuestions(self::$id);
    }

    public function answer() {
        UserController::mustBeLoggedIn();
        $profileModel = new Profile();
        $points = array_sum($_POST);
        $userId = $_SESSION["user"]["codigo"];
        $success = $profileModel->setProfile($points, $userId);

        $home = BASE_URL;
        if ($success) {
            $message = "Perfil definido com sucesso";
        } else {
            $message = "Erro ao definir perfil, tente novamente";
        }
        echo "<script>alert('$message'); location.href='$home'</script>";
    }
}