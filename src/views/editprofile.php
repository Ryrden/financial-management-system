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

    <?php include "src/partials/links.php" ?>
    <title>Editar perfil | Sistema de Gestão Financeira</title>
</head>

<body>
<div class="container-fluid bg-half">
    <?php include "src/partials/navbar.php" ?>

    <div class="container-fluid py-3 mt-sm-5">

        <div class="row">
            <?php include "src/partials/menu.php" ?>
            <div class="col-12 col-sm-8 col-lg-9">
                <h1 class="text-dark text-sm-light mb-5">Editar perfil</h1>
                <div class="container bg-white p-3 rounded">
                    <h2 class="text-dark my-3">Preencha os novos dados</h2>
                    <form action="<?= BASE_URL."/user/update" ?>" enctype="multipart/form-data" method="post" id="editForm">
                        <div class="form-group">
                            <label for="nome" class="text-dark">Nome</label>
                            <input value="<?= $_SESSION["user"]["nome"] ?>" type="text" name="nome" id="nome" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="image" class="text-dark">Nova imagem de perfil</label>
                            <input type="file" class="d-block text-dark" name="image" id="image">
                        </div>
                        <div class="form-group">
                            <label for="currentPassword" class="text-dark">Senha antiga</label>
                            <input type="password" placeholder="Apenas caso deseje trocar sua senha" class="form-control" name="currentPassword" id="currentPassword">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-dark">Senha</label>
                            <input minlength="6" type="password" name="password" id="password" class="form-control">
                            <small class="text-dark">Digite a senha apenas se deseja trocá-la</small>
                        </div>
                        <div class="form-group">
                            <label for="passwordConfirm" class="text-dark">Confirmar senha</label>
                            <input minlength="6" type="password" name="passwordConfirm" id="passwordConfirm" class="form-control">
                        </div>
                        <button class="btn btn-primary" type="submit">Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const form = document.getElementById("editForm");
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