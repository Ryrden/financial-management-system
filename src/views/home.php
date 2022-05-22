<?php
    if (!isset($_SESSION))
        session_start();
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

    <style><?php include "src/styles/style.css"?></style>
    <title>Sistema de Gestão Financeira</title>
</head>

<body>
<div class="container-fluid">
    <div class="container-fluid pt-3">
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
                        <li><a class="nav-link" active href="#">Home</a></li>
                        <li><a class="nav-link" href="#">Questionário</a></li>
                        <li><a class="nav-link" href="#">Docs</a></li>
                    </ul>
                    <div class="col-md-2 col-sm-3 rounded-pill p-0 mb-1" id="userPicName">
                        <img src="https://i.imgur.com/e6BoP1f.jpg" alt="..." class="rounded-circle">
                        <span id="userName">Nome</span>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <!-- CONTENT -->
        <div class="d-flex flex-row justify-content-center pt-5">
            <!-- Primeira Coluna -->
            <div class="col-md-3">
                <div class="d-flex flex-column offset-3">
                    <div class="d-flex flex-column align-items-center text-center ">
                        <img src="https://i.imgur.com/e6BoP1f.jpg" alt="..." class="border-dark m-3 rounded-circle"
                            width="100px">
                        <div class="d-flex flex-column mb-2">
                            <span id="userName">Nome do usuário</span>
                            <span>Perfil econômico</span>
                        </div>
                        <div id="moneyDiv" class="rounded-pill">
                            <i class='bi bi-coin'></i>
                            <span id="userMoney">R$ 0,00</span>
                        </div>
                    </div>
                    <div class="container d-flex flex-row my-5">
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
                <div class="h2 mb-5" id="subTitle">Seja Bem-vindo(a), <span id="userName">Nome do usuário!</span></div>
                <div class="d-flex flex-row" id="content">
                    <div class="primaryContent bg-danger col-7">a</div>
                    <div class="col-5 row">
                        <div class="col-9 secondContent bg-warning">a</div>
                        <div class="col-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>