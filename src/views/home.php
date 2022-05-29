<?php
if (!isset($_SESSION))
    session_start();
$model = new Transaction();
$transactions = $model->list($_SESSION["user"]["codigo"], $_GET['page'] ?? 1);
$maxPages = $model->getMaxPages($_SESSION["user"]["codigo"]);
$currentPage = $_GET["page"] ?? 1;
$pagePreviewOffset = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include "src/partials/links.php" ?>
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
                    <h1 class="h2 mb-5 text-dark text-sm-light" id="subTitle">Seja Bem-vindo(a), <?=$_SESSION["user"]["nome"]?></h1>
                    <div class="primaryContent bg-white rounded-lg">
                        <div class="container py-3 gap-2">
                            <h2 class="text-dark pb-3 pt-2">Últimas Movimentações</h2>
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
                                                <form method="post" class="deleteForm" action="<?=BASE_URL."/transaction/delete"?>">
                                                    <input name="id" type="hidden" value="<?= $transaction->id ?>">
                                                    <button type="submit" style="border: none; background: none">
                                                        <img src="https://res.cloudinary.com/davifelix/image/upload/v1653691871/trash_vc1qeq.svg" alt="Lixeira">
                                                    </button>
                                                </form>
                                                <button class="btnEdit" data-id="<?=$transaction->id?>"
                                                    data-data="<?=$transaction->data?>"
                                                    data-valor="<?=$transaction->valor?>"
                                                    data-tipo="<?=$transaction->tipo?>" data-nome="<?=$transaction->nome?>"
                                                    style="border: none; background: none;" type="button"
                                                    data-toggle="modal" data-target="#editTransactionModal">
                                                    <img src="https://res.cloudinary.com/davifelix/image/upload/v1653691871/edit_ziuzdh.svg" alt="Editar">
                                                </button>

                                            </div>
                                        </div>

                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                            <div>
                                <?php if ($transactions) { ?>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">

                                        <?php if (isset($currentPage) && $currentPage > 1) { ?>
                                            <li class="page-item"><a class="page-link" href="?page=<?= $_GET["page"] - 1 ?>">Previous</a></li>
                                        <?php }?>

                                        <li class="page-item <?= $currentPage == 1 ? "active" : "" ?>"><a href="?page=1" class="page-link">1</a></li>
                                        <?php if ($currentPage > 1 && $currentPage - 2 * $pagePreviewOffset > 1) { ?>
                                            <li class="page-item"><div class="page-link">...</div></li>
                                        <?php }?>

                                        <?php for ($i = $currentPage - $pagePreviewOffset; $i <= $currentPage + $pagePreviewOffset && $i < $maxPages; $i++) { ?>
                                                <?php if ($i > 1) { ?>
                                                    <li class="page-item <?= $currentPage == $i ? "active" : "" ?>"><a class="page-link" href="?page=<?=$i?>"><?= $i ?></a></li>
                                                <?php }?>
                                        <?php }?>

                                        <?php if ($currentPage != $maxPages && $currentPage + 2 * $pagePreviewOffset < $maxPages) { ?>
                                            <li class="page-item"><div class="page-link">...</div></li>
                                            <li class="page-item"><a href="?page=<?=$maxPages?>" class="page-link"><?=$maxPages?></a></li>
                                        <?php } else { ?>
                                            <li class="page-item <?= $currentPage == $maxPages ? "active" : "" ?>"><a href="?page=<?=$maxPages?>" class="page-link"><?=$maxPages?></a></li>
                                        <?php } ?>

                                        <?php if ($currentPage < $maxPages) { ?>
                                            <li class="page-item"><a class="page-link" href="?page=<?= $currentPage + 1 ?>">Next</a></li>
                                        <?php }?>
                                    </ul>
                                </nav>
                                <?php } ?>
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

                    Array.from(document.getElementsByClassName("deleteForm")).forEach(form => {
                        form.addEventListener("submit", (e) => {
                            e.preventDefault();
                            if (window.confirm("Certeza que deseja deletar a transação?"))
                                form.submit();
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
                                    <label class="text-dark" for="tipo">Tipo de movimentação</label>
                                    <select class="form-control" name="tipo" id="tipo">
                                        <option value="ganho" selected>Ganho</option>
                                        <option value="gasto">Gasto</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-dark" for="data">Data</label>
                                    <input type="date" class="form-control" id="data" name="data">
                                </div>
                                <button type="submit" class="btn btn-primary align-self-end">Adicionar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <!-- Segunda coluna -->
</body>

</html>