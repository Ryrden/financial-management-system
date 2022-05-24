<?php
    if (!isset($_SESSION))
        session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include "src/partials/links.php" ?>
    </style>
    <title>Login</title>
</head>

<body>
    <div class="bg-half bigger d-flex vh-100 justify-content-center align-items-center">
        <div class="bg-light container col-md-4 border shadow p-4 rounded-lg">
            <h1 class="text-dark">Login</h1>
            <p class="text-dark">Entre com sua conta para continuar</p>
            <form method="post" action="<?=BASE_URL."/user/login"?>" class="mt-5">
                <div class="form-group mb-4">
                    <label for="email" class="text-dark">Endereço de e-mail</label>
                    <input name="email" type="email" class="form-control" id="email" aria-describedby="email"
                        placeholder="nome@exemplo.com">
                </div>
                <div class="form-group mb-5">
                    <label for="password" class="text-dark">Senha</label>
                    <input name="password" type="password" class="form-control" id="password"
                        placeholder="Pelo menos 6 caracteres">
                </div>
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill mb-3 text-white">Entrar</button>
                <p class="text-dark">Não é registrado? <a href="<?=BASE_URL."/cadastro"?>">Criar conta</a></p>
            </form>
        </div>
    </div>
</body>

</html>