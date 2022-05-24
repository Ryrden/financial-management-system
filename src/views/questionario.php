<?php
if (!isset($_SESSION))
    session_start();
$questions = QuestionarioController::listQuestions();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include "src/partials/links.php" ?>
    <title>Questionário | Sistema de Gestão Financeira</title>
</head>

<body>
    <div class="container-fluid bg-half">
        <div class="container-fluid py-3">

            <!-- NAVBAR -->
            <?php include "src/partials/navbar.php" ?>
            <!-- CONTENT -->
            <div class="d-flex flex-row justify-content-center pt-5">
                <!-- Primeira Coluna -->
                <?php include "src/partials/menu.php" ?>
                <!-- Segunda coluna -->
                <div class="col-md-9">
                    <div class="h2 mb-5" id="subTitle">Seja Bem-vindo(a), <?=$_SESSION["user"]["nome"]?></div>
                    <div class="primaryContent p-3 text-dark bg-white rounded-lg">
                        <h2 class="pb-2 border-bottom border-dark">Perguntas</h2>

                        <form method="POST" action="<?= BASE_URL."/questionario/answer" ?>" class="d-flex flex-column"
                            action="">
                            <?php foreach ($questions as $question) { ?>
                            <div class="my-3">
                                <p class="lead"><strong><?=$question['texto']?></strong></p>
                                <div class="list-group">
                                    <?php foreach ($question['alternatives'] as $alternative) { ?>
                                    <label for="<?= $alternative['id'] ?>" class="list-group-item">
                                        <input type="radio" id="<?= $alternative['id'] ?>"
                                            value="<?= $alternative['pontuacao'] ?>" name="<?= $question['id'] ?>">
                                        <span> <?=$alternative['texto'] ?></span>
                                    </label>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                            <button type="submit" class="btn btn-primary align-self-end">Responder</button>
                        </form>
                    </div>
                </div>
</body>

</html>