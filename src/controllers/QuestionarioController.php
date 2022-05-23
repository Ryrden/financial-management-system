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
}