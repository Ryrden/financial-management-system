<?php
    UserController::refreshUser($_SESSION["user"]["email"]);
    $income = Format::formatMoneyValue($_SESSION["user"]["renda"] / 100)
?>
<div class="col col-sm-4 col-lg-3 my-3 my-md-0">
    <!-- Primeira Coluna -->
    <div class="container">
        <div class="row flex-column justify-content-center align-items-center menu-lateral">
            <?= (new Upload())->getTransformedImage($_SESSION["user"]["imagem"]) ?>
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
                        <img alt="Home" class="m-2" src="https://res.cloudinary.com/davifelix/image/upload/v1653691871/home_nyzkem.svg" width="52" height="52">
                        <span>Home</span>
                    </div>
                </a>
                <a href="<?=BASE_URL."/profile"?>">
                    <div class="d-flex flex-column align-items-center">
                        <img alt="Perfil" class="m-2" src="https://res.cloudinary.com/davifelix/image/upload/v1653691871/pessoa_cxr8tl.svg" width="52" height="52">
                        <span>Perfil</span>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4">
                <a href="<?=BASE_URL."/questionario"?>">
                    <div class="d-flex flex-column align-items-center">
                        <img alt="Question??rio" class="m-2" src="https://res.cloudinary.com/davifelix/image/upload/v1653691871/questionario_pdef9b.svg" width="52" height="52">
                        <span>Question??rio</span>
                    </div>
                </a>
                <a href="<?= BASE_URL."/documentos" ?>">
                    <div class="d-flex flex-column align-items-center">
                        <img alt="Documentos" class="m-2" src="https://res.cloudinary.com/davifelix/image/upload/v1653691871/documentos_iwghgs.svg" width="52" height="52">
                        <span>Documentos</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>