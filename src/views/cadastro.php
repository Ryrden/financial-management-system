<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include "src/partials/links.php" ?>
    </style>
    <title>Cadastro</title>
</head>

<body>
    <div class="bg-half d-flex vh-100 justify-content-center align-items-center">
        <div class="container bg-light col-md-4 border shadow p-4 rounded-lg">
            <h1 class="text-dark">Cadastro</h1>
            <p class="text-dark">Preencha as caixas abaixo com seus dados</p>
            <form id="registerForm" method="post" action="<?=BASE_URL."/user/register"?>">
                <div class="form-group">
                    <label for="name" class="text-dark">Seu nome</label>
                    <input name=" name" type="text" class="form-control" id="name" aria-describedby="text"
                        placeholder="Seu nome completo">
                </div>
                <div class="form-group">
                    <label for="email" class="text-dark">Endereço de e-mail</label>
                    <input name="email" type="email" class="form-control" id="email" aria-describedby="email"
                        placeholder="nome@exemplo.com">
                </div>
                <div class="form-group">
                    <label for="password" class="text-dark">Senha</label>
                    <input name="password" minlength="6" type="password" class="form-control" id="password"
                        placeholder="Pelo menos 6 caracteres">
                </div>
                <div class="form-group">
                    <label for="passwordConfirm" class="text-dark">Confirmar Senha</label>
                    <input type="password" minlength="6" class="form-control" id="passwordConfirm">
                </div>
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill text-white">Entrar</button>
                <p>Já possui conta? <a href="<?php echo BASE_URL ?>/login">Fazer login</a></p>
            </form>
        </div>
    </div>
    <script>
    const form = document.getElementById("registerForm");
    form.addEventListener("submit", e => {
        e.preventDefault()
        const passwordInput = document.getElementById("password")
        const passwordConfirmInput = document.getElementById("passwordConfirm")
        if (passwordInput.value !== passwordConfirmInput.value) {
            alert("As senhas não cofirmam")
        } else {
            e.target.submit();
        }
    })
    </script>
</body>

</html>