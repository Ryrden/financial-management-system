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
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js" async></script>

    <?php include "src/partials/links.php" ?>
    <style>
        .selected {
            background-color: var(--MarromEscuro);
            border-color: var(--MarromEscuro);
        }
        button.selected:hover,
        button.selected:active,
        button.selected:enabled {
            background-color: var(--MarromIdeal);
            border-color: var(--MarromIdeal);
            outline-color: var(--MarromIdeal);
        }

    </style>
    <title>Perfil | Sistema de Gestão Financeira</title>
</head>

<body>
<div class="container-fluid bg-half">
    <?php include "src/partials/navbar.php" ?>

    <div class="container-fluid py-3">

        <div class="row">
            <?php include "src/partials/menu.php" ?>
            <div class="col-12 col-sm-8 col-lg-9">
                <h1>Gerar documentos</h1>
            </div>
        </div>
    </div>
</body>

</html>