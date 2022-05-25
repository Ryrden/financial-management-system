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
        <!-- NAVBAR -->
        <?php include "src/partials/navbar.php" ?>
        <div class="container-fluid py-3 mt-sm-5">

            <div class="row">
                <!-- Primeira Coluna -->
                <?php include "src/partials/menu.php" ?>
                <!-- Segunda coluna -->
                <div class="col-12 col-sm-8 col-lg-9">
                    <div class="h2 mb-5 text-sm-light text-dark" id="subTitle">Questionário de perfil</div>
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
        </div>
    </div>
</body>

</html>