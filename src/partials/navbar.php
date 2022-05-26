<div class="container mt-4">
    <div class="row">
        <div class="col-md-3 align-self-center">
            <div id="logoSystem">
                <p class="text-center m-0">Sistema de Gestão financeira</p>
            </div>
        </div>
        <div class="col-md-9 ml-auto">
                <div class="container">
                    <div class="row align-items-center">
                        <ul class="col-md-9 col-sm-9 nav justify-content-center justify-content-sm-start">
                            <li><a class="nav-link" href="<?=BASE_URL?>">Home</a></li>
                            <li><a class="nav-link" href="<?=BASE_URL."/questionario"?>">Questionário</a></li>
                            <li><a class="nav-link" href="<?= BASE_URL."/documentos" ?>">Docs</a></li>
                        </ul>
                        <a href="<?=BASE_URL."/user/logout/"?>"
                           class="d-flex justify-content-between col-md-3 col-sm-3 rounded-pill p-0 mb-1"
                           id="userPicName">
                            <img src="<?= $_SESSION["user"]["imagem"] ?>" alt="..." class="rounded-circle">
                            <p class="m-0 w-100 d-flex justify-content-center text-light">Logout</p>
                        </a>
                    </div>
                </div>
            <hr>
        </div>
    </div>

</div>