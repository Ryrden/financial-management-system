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

    <!-- Bootstrap Links -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <script defer src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
            integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        <?php include "src/styles/style.css"?>
    </style>
    <title>Questionário | Sistema de Gestão Financeira</title>
</head>

<body>
<div class="container-fluid bg-half">
    <div class="container-fluid py-3">

        <!-- NAVBAR -->
        <div class="d-flex flex-row ">
            <div class="col-md-3 d-flex justify-content-center align-items-center">
                <div id="logoSystem">
                    <p class="text-center m-0">Sistema de Gestão financeira</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="d-flex flex-row align-items-center">
                    <ul class="col-md-10 col-sm-9 nav">
                        <li><a class="nav-link" href="#">Home</a></li>
                        <li><a class="nav-link" href="#">Questionário</a></li>
                        <li><a class="nav-link" href="#">Docs</a></li>
                    </ul>
                    <a href="<?=BASE_URL."/user/logout/"?>"
                       class="d-flex justify-content-between col-md-2 col-sm-3 rounded-pill p-0 mb-1"
                       id="userPicName">
                        <img src="https://i.imgur.com/e6BoP1f.jpg" alt="..." class="rounded-circle">
                        <p class="m-0 w-100 d-flex justify-content-center text-light">Logout</p>
                    </a>
                </div>
                <hr>
            </div>
        </div>
        <!-- CONTENT -->
        <div class="d-flex flex-row justify-content-center pt-5">
            <!-- Primeira Coluna -->
            <div class="col-md-3">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-column align-items-center text-center offset-3">
                        <img src="https://i.imgur.com/e6BoP1f.jpg" alt="..." class="border-dark m-3 rounded-circle"
                             width="100px">
                        <div class="d-flex flex-column mb-2">
                            <span id="userName"><?=$_SESSION["user"]["nome"]?></span>
                            <span>Perfil econômico</span>
                        </div>
                        <div id="moneyDiv"
                             class="d-flex align-items-center rounded-pill moneyDiv justify-content-center p-2 text-dark">
                            <i class='bi bi-coin'></i>
                            <span id="userMoney">R$ 0,00</span>
                        </div>
                    </div>
                    <div class="container d-flex flex-row justify-content-center mt-5">
                        <div class="col-md">
                            <a href="#">
                                <div class="d-flex flex-column align-items-center">
                                    <img class="m-2" src="src/imgs/home.svg" width="52" height="52">
                                    <span>Home</span>
                                </div>
                            </a>
                            <a href="#">
                                <div class="d-flex flex-column align-items-center">
                                    <img class="m-2" src="src/imgs/pessoa.svg" width="52" height="52">
                                    <span>Perfil</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-md">
                            <a href="#">
                                <div class="d-flex flex-column align-items-center">
                                    <img class="m-2" src="src/imgs/questionario.svg" width="52" height="52">
                                    <span>Questionário</span>
                                </div>
                            </a>
                            <a href="#">
                                <div class="d-flex flex-column align-items-center">
                                    <img class="m-2" src="src/imgs/documentos.svg" width="52" height="52">
                                    <span>Documentos</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Segunda coluna -->
            <div class="col-md-9">
                <div class="h2 mb-5" id="subTitle">Seja Bem-vindo(a), <?=$_SESSION["user"]["nome"]?></div>
                <div class="primaryContent p-3 text-dark bg-white rounded-lg">
                    <h2 class="pb-2 border-bottom border-dark">Perguntas</h2>

                    <form class="d-flex flex-column" action="">
                        <?php foreach ($questions as $question) { ?>
                            <div class="my-3">
                                <p class="lead"><strong><?=$question['texto']?></strong></p>
                                <div class="list-group">
                                <?php foreach ($question['alternatives'] as $alternative) { ?>
                                    <label for="<?= $alternative['id'] ?>" class="list-group-item">
                                        <input type="radio" id="<?= $alternative['id'] ?>" value="<?= $question['pontuacao'] ?>" name="<?= $question['id'] ?>">
                                        <span> <?=$alternative['texto'] ?></span>
                                    </label>
                                <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="my-3">
                            <p class="lead"><strong>O que você ganha por mês é suficiente para arcar com os seus gastos?</strong></p>
                            <div class="list-group">
                                <label for="1a" class="list-group-item">
                                    <input type="radio" id="1a" value="10" name="1">
                                    <span> Consigo pagar minhas contas e ainda guardo mais 10% dos meus ganhos todo mês;</span>
                                </label>
                                <label for="1b" class="list-group-item">
                                    <input type="radio" id="1b" value="5" name="1">
                                    <span> Consigo pagar minhas contas e ainda guardo mais 10% dos meus ganhos todo mês;</span>
                                </label>
                                <label for="1c" class="list-group-item">
                                    <input type="radio" id="1c" value="0" name="1">
                                    <span> Consigo pagar minhas contas e ainda guardo mais 10% dos meus ganhos todo mês;</span>
                                </label>
                            </div>
                        </div>
                        <div class="my-3">
                            <p class="lead"><strong>O que você ganha por mês é suficiente para arcar com os seus gastos?</strong></p>
                            <div class="list-group">
                                <label for="1a" class="list-group-item">
                                    <input type="radio" id="1a" value="10" name="1">
                                    <span> Consigo pagar minhas contas e ainda guardo mais 10% dos meus ganhos todo mês;</span>
                                </label>
                                <label for="1b" class="list-group-item">
                                    <input type="radio" id="1b" value="5" name="1">
                                    <span> Consigo pagar minhas contas e ainda guardo mais 10% dos meus ganhos todo mês;</span>
                                </label>
                                <label for="1c" class="list-group-item">
                                    <input type="radio" id="1c" value="0" name="1">
                                    <span> Consigo pagar minhas contas e ainda guardo mais 10% dos meus ganhos todo mês;</span>
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary align-self-end">Responder</button>
                </form>
                </div>
</div>
</body>

</html>