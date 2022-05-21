<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>

    <!-- Bootstrap Links -->
    <style>
        <?php include("src/styles/style.css"); ?>
    </style>
    <title>Cadastro</title>
</head>

<body>
    <div class="d-flex vh-100 justify-content-center align-items-center">
        <div class="container col-md-4 border shadow p-4 rounded-lg">
            <h1>Cadastro</h1>
            <p>Preencha as caixas abaixo com seus dados</p>
            <form id="registerForm" method="post" action="http://localhost/financial-management-system/index.php/user/register">
                <div class="form-group">
                    <label for="name">Seu nome</label>
                    <input name="name" type="text" class="form-control" id="name" aria-describedby="text" placeholder="Seu nome completo">
                </div>
                <div class="form-group">
                    <label for="email">Endereço de e-mail</label>
                    <input name="email" type="email" class="form-control" id="email" aria-describedby="email" placeholder="nome@exemplo.com">
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Pelo menos 6 caracteres">
                </div>
                <div class="form-group">
                    <label for="password">Confirmar Senha</label>
                    <input type="password" class="form-control" id="passwordConfirm">
                </div>
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">Entrar</button>
                <p>Já possui conta? <a href="login.php">Fazer login</a></p>
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