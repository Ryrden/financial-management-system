<?php
    UserController::updateUser($_SESSION["user"]["email"]);
    $income = Format::formatMoneyValue($_SESSION["user"]["renda"] / 100)
?>
<div class="d-flex flex-row justify-content-center pt-5">
    <!-- Primeira Coluna -->
    <div class="col-md-3">
        <div class="d-flex flex-column">
            <div class="d-flex flex-column align-items-center text-center offset-3">
                <img src="https://i.imgur.com/e6BoP1f.jpg" alt="..." class="border-dark m-3 rounded-circle"
                     width="100px">
                <div class="d-flex flex-column mb-2">
                    <span id="userName"><?=$_SESSION["user"]["nome"]?></span>
                    <span><?= $_SESSION["user"]["perfil"] ?? "" ?></span>
                </div>
                <div id="moneyDiv"
                     class="d-flex align-items-center rounded-pill moneyDiv justify-content-center p-2 text-dark">
                    <i class='bi bi-coin'></i>
                    <span id="userMoney"><?=$income ?></span>
                </div>
            </div>
            <div class="container d-flex flex-row justify-content-center mt-5">
                <div class="col-md">
                    <a href="<?=BASE_URL?>">
                        <div class="d-flex flex-column align-items-center">
                            <img class="m-2" src="src/imgs/home.svg" width="52" height="52">
                            <span>Home</span>
                        </div>
                    </a>
                    <a href="<?=BASE_URL."/profile"?>">
                        <div class="d-flex flex-column align-items-center">
                            <img class="m-2" src="src/imgs/pessoa.svg" width="52" height="52">
                            <span>Perfil</span>
                        </div>
                    </a>
                </div>
                <div class="col-md">
                    <a href="<?=BASE_URL."/questionario"?>">
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