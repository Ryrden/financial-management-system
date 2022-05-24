<?php
if (!isset($_SESSION))
    session_start();
$model = new Transaction();
$transactions = $model->list($_SESSION["user"]["codigo"], $_GET['page'] ?? 1);
$maxPages = $model->getMaxPages($_SESSION["user"]["codigo"]);
$currentPage = $_GET["page"] ?? 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Links -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <script defer src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
    <?php include "src/styles/style.css"?>
    </style>
    <title>Sistema de Gestão Financeira</title>
</head>

<body>
    <div class="container-fluid bg-half">
        <!-- Modal -->
        <?php include "src/partials/editModal.php" ?>
        <!-- NAVBAR -->
        <?php include "src/partials/navbar.php" ?>
        <div class="container-fluid py-3 mt-sm-5">
            <!-- Primeira Coluna -->
            <div class="row">
                <?php include "src/partials/menu.php" ?>

                <div class="col-12 col-sm-8 col-lg-9">
                    <div class="h2 mb-5 text-dark text-sm-light" id="subTitle">Seja Bem-vindo(a), <?=$_SESSION["user"]["nome"]?></div>
                    <div class="primaryContent bg-white rounded-lg">
                        <div class="container py-3 gap-2">
                            <h2 class="text-dark pb-3 pt-2">Últimar Movimentações</h2>
                            <ul class="p-0">
                                <?php if (count($transactions) == 0) { ?>
                                <p class="text-dark">Não há transações</p>
                                <?php } ?>
                                <?php foreach ($transactions as $index => $transaction) { ?>
                                <li class="w-100 mb-2">
                                    <div class="align-items-center">
                                        <div class="d-flex justify-content-between align-items-center col-12 text-dark rounded py-2 <?= $transaction->tipo == "gasto" ? "outcome" : "income" ?>">
                                            <div class="d-flex flex-column">
                                                <p class="m-0"><?=$transaction->formattedData?></p>
                                                <p class="m-2"><?=$transaction->nome?></p>
                                                <p class="m-0 <?=$transaction->tipo == "gasto" ? "text-danger" : "text-success"?>">
                                                    <?= ($transaction->tipo == "gasto" ? "- " : "").$transaction->formattedValor ?>
                                                </p>
                                            </div>
                                            <div class="d-flex flex-column flex-sm-row">
                                                <a href="<?=BASE_URL."/transaction/delete?id=".$transaction->id?>">
                                                    <img src="src/imgs/trash.svg" alt="Lixeira">
                                                </a>
                                                <button class="btnEdit" data-id="<?=$transaction->id?>"
                                                    data-data="<?=$transaction->data?>"
                                                    data-valor="<?=$transaction->valor?>"
                                                    data-tipo="<?=$transaction->tipo?>" data-nome="<?=$transaction->nome?>"
                                                    style="border: none; background: none;" type="button"
                                                    data-toggle="modal" data-target="#editTransactionModal">
                                                    <img src="src/imgs/edit.svg" alt="Editar">
                                                </button>

                                            </div>
                                        </div>

                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                            <div class="m-auto">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">

                                        <?php if (isset($currentPage) && $currentPage > 1) { ?>
                                            <li class="page-item"><a class="page-link" href="?page=<?= $_GET["page"] - 1 ?>">Previous</a></li>
                                            <li class="page-item"><a href="?page=1" class="page-link">1</a></li>
                                            <li class="page-item"><div class="page-link">...</div></li>
                                        <?php }?>

                                        <?php for ($i = $currentPage - 3; $i < $maxPages; $i++) { ?>
                                                <?php if ($i > 1) { ?>
                                                    <li class="page-item <?= $currentPage == $i ? "active" : "" ?>"><a class="page-link" href="?page=<?=$i?>"><?= $i ?></a></li>
                                                <?php }?>
                                        <?php }?>

                                        <?php if ($currentPage != $maxPages) { ?>
                                            <li class="page-item"><div class="page-link">...</div></li>
                                            <li class="page-item"><a href="?page=<?=$maxPages?>" class="page-link"><?=$maxPages?></a></li>
                                        <?php }?>

                                        <?php if (isset($currentPage) && $currentPage < $maxPages) { ?>
                                            <li class="page-item"><a class="page-link" href="?page=<?= $currentPage + 1 ?>">Next</a></li>
                                        <?php }?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <script>
                    const buttons = document.querySelectorAll(".btnEdit");
                    const fields = ["id", "valor", "nome", "tipo", "data"];
                    buttons.forEach(btn => {
                        btn.addEventListener("click", () => {
                            fields.forEach(field => {
                                const id =
                                    `modal${field.charAt(0).toUpperCase() + field.slice(1)}`;
                                const element = document.getElementById(id);
                                if (field === "valor")
                                    element.setAttribute("value", String(btn.dataset[field] /
                                        100));
                                else if (field === 'tipo')
                                    document.querySelector(
                                        `option[value=${btn.dataset[field]}]`).setAttribute(
                                        "selected", true);
                                else
                                    element.setAttribute("value", btn.dataset[field]);
                            })
                        })
                    })
                    </script>
                    <div class="primaryContent bg-white rounded-lg mt-4">
                        <div class="container py-3 gap-2">
                            <h2 class="text-dark pb-3 pt-2">Adicionar movimentação</h2>
                            <form action="<?=BASE_URL."/transaction/insert"?>" method="post" class="d-flex flex-column">
                                <div class="form-group">
                                    <label class="text-dark" for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome"
                                        placeholder="Nome da movimentação">
                                </div>
                                <div class="form-group">
                                    <label class="text-dark" for="valor">Valor</label>
                                    <input type="number" step="0.01" class="form-control" id="valor" name="valor"
                                        placeholder="00.00">
                                </div>
                                <div class="form-group">
                                    <label class="text-dark" for="tipo">Example select</label>
                                    <select class="form-control" name="tipo" id="tipo">
                                        <option value="ganho" selected>Ganho</option>
                                        <option value="gasto">Gasto</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-dark" for="data">Data</label>
                                    <input type="date" class="form-control" id="data" name="data">
                                </div>
                                <button type="submit" class="btn btn-primary align-self-end">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <!-- Segunda coluna -->
</body>

</html>