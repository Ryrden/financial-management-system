<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>

    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
    <!-- Bootstrap Links -->

    <!-- Bootstrap Font Icon Link -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- CSS Link -->
    <style>
    <?php include("src/styles/style.css");
    ?>
    </style>
    <title>Sistema de Gestão Financeira</title>
</head>

<body>
    <div class="container-fluid">
        <!-- NAVBAR -->
        <div class="d-flex flex-row ">
            <div class="col-sm-3 d-flex align-items-center">
                <div class="offset-1">
                    <span class="py-2 px-3 border border-dark rounded">Sistema de Gestão financeira</span>
                </div>
            </div>
            <div class="col-sm-9 ">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <ul class="col-10 nav pt-3">
                        <li class="nav-item"><a class="nav-link" active href="#">Home</a></li>
                        <li><a class="nav-link" href="#">Questionário</a></li>
                        <li><a class="nav-link" href="#">Docs</a></li>
                    </ul>
                    <div class="col-2 mt-3 p-0 d-flex align-items-center justify-content-between bg-dark rounded-pill ">
                        <img src="https://i.imgur.com/e6BoP1f.jpg" alt="..." class="border-dark rounded-circle"
                            width="50px">
                        <span class="mx-1" id=" userName">Nome do usuário</span>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <!-- CONTENT -->
        <div class="d-flex flex-row justify-content-center">
            <div class="col-sm-3">
                <div class="d-flex flex-column align-items-center text-center my-5 offset-3">
                    <div>
                        <img src="https://i.imgur.com/e6BoP1f.jpg" alt="..." class="border-dark rounded-circle"
                            width="100px">
                    </div>
                    <span id="userName">Nome do usuário</span>
                    <span>Perfil econômico</span>
                    <div class="px-1 py-1 bg-light rounded-pill d-flex justify-content-between align-items-center">
                        <i class='bi bi-coin'></i> R$ 1000,00
                    </div>
                    <div class="container d-flex flex-row my-5">
                        <div class="col-sm">
                            <div class="d-flex flex-column align-items-center">
                                <img class="m-2" src="src/imgs/home.svg" width="52" height="52">
                                <span>Home</span>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <img class="m-2" src="src/imgs/pessoa.svg" width="52" height="52">
                                <span>Perfil</span>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex flex-column align-items-center">
                                <img class="m-2" src="src/imgs/questionario.svg" width="52" height="52">
                                <span>Questionário</span>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <img class="m-2" src="src/imgs/documentos.svg" width="52" height="52">
                                <span>Documentos</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="h2" id="subTitle">Seja Bem-vindo(a), <span id="userName">Nome do
                        usuário!</span></div>
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