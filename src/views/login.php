<!DOCTYPE html>
<html lang="pt-BR">

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

    <!-- Bootstrap Links -->
    <style>
    <?php include("src/styles/style.css");
    ?>
    </style>
    <title>Login</title>
</head>

<body>
    <div class="d-flex vh-100 justify-content-center align-items-center">
        <div class="bg-light container col-md-4 border shadow p-4 rounded-lg">
            <h1 class="text-dark">Login</h1>
            <p class="text-dark">Entre com sua conta para continuar</p>
            <form method="post" action="http://localhost/financial-management-system/index.php/user/login" class="mt-5">
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
                <p class="text-dark">Não é registrado? <a href="cadastro">Criar conta</a></p>
            </form>
        </div>
    </div>
</body>

</html>