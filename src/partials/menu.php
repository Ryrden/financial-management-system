<?php
    UserController::refreshUser($_SESSION["user"]["email"]);
    $income = Format::formatMoneyValue($_SESSION["user"]["renda"] / 100)
?>
<div class="col col-sm-4 col-lg-3">
    <!-- Primeira Coluna -->
    <div class="container">
        <div class="row flex-column justify-content-center align-items-center">
            <img style="cursor: pointer" src="<?= $_SESSION["user"]["imagem"] ?>" alt="..." class="border-dark m-3 rounded-circle" width="100px">
            <div class="d-flex flex-column">
                <span id="userName"><?=$_SESSION["user"]["nome"]?></span>
                <span><?= $_SESSION["user"]["perfil"] ?? "" ?></span>
            </div>
            <div id="moneyDiv"
                 class="d-flex align-items-center rounded-pill moneyDiv justify-content-center p-2 text-dark my-3">
                <i class='bi bi-coin'></i>
                <span id="userMoney"><?=$income ?></span>
            </div>
            <div class="mb-2">
                <a class="btn btn-primary" href="<?=BASE_URL."/editprofile"?>">Editar perfil</a>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-3 col-sm-4">
                <a href="<?=BASE_URL?>">
                    <div class="d-flex flex-column align-items-center">
                        <img alt="Home" class="m-2" src="https://res.cloudinary.com/davifelix/image/upload/v1653501383/home_qywcac.svg" width="52" height="52">
                        <span>Home</span>
                    </div>
                </a>
                <a href="<?=BASE_URL."/profile"?>">
                    <div class="d-flex flex-column align-items-center">
                        <img alt="Perfil" class="m-2" src="https://res.cloudinary.com/davifelix/image/upload/v1653501383/pessoa_i95ddb.svg" width="52" height="52">
                        <span>Perfil</span>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4">
                <a href="<?=BASE_URL."/questionario"?>">
                    <div class="d-flex flex-column align-items-center">
                        <img alt="Questionário" class="m-2" src="https://res.cloudinary.com/davifelix/image/upload/v1653501384/questionario_ppznng.svg" width="52" height="52">
                        <span>Questionário</span>
                    </div>
                </a>
                <a href="<?= BASE_URL."/documentos" ?>">
                    <div class="d-flex flex-column align-items-center">
                        <img alt="Documentos" class="m-2" src="https://res.cloudinary.com/davifelix/image/upload/v1653501383/documentos_kb6u7f.svg" width="52" height="52">
                        <span>Documentos</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>