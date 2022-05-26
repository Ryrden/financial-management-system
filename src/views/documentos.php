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
    <title>Documentos | Sistema de Gestão Financeira</title>
</head>

<body>
<div class="container-fluid bg-half">
    <?php include "src/partials/navbar.php" ?>

    <div class="container-fluid py-3 mt-sm-5">

        <div class="row">
            <?php include "src/partials/menu.php" ?>
            <div class="col-12 col-sm-8 col-lg-9">
                <h1 class="text-dark text-sm-light mb-5">Gerar documentos</h1>
                <div class="container bg-white p-3 rounded">
                    <h2 class="text-dark my-3">Preencha os dados do seu extrado</h2>
                    <form action="<?= BASE_URL."/documentos/generate" ?>" method="post">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="text-dark" for="dataInicio">Data de início</label>
                                        <input class="form-control" type="date" name="dataInicio" id="dataInicio">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="text-dark"  for="dataFim">Data final</label>
                                        <input class="form-control" type="date" name="dataFim" id="dataFim">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="text-dark" for="tipoExtrato">Tipo de extrato</label>
                                        <select id="tipoExtrato" name="tipoExtrado"  type="text" class="form-control">
                                            <option value="gastos">Gastos</option>
                                            <option value="ganhos">Gastos</option>
                                            <option value="gastos_ganhos">Gastos e ganhos</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col justify-content-end d-flex">
                                    <button class="btn btn-primary" type="submit">Gerar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>