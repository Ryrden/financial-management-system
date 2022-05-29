<?php
UserController::mustBeLoggedIn();
$model = new Transaction();
$date1 = $_GET['dataInicio'];
$date2 = $_GET['dataFim'];
$tipo = $_GET['tipo'];
$grafico = array_key_exists("grafico", $_GET) && $_GET["grafico"] == "on";
$dateStart = date('Y-m-d', strtotime($date1));
$dateEnd = date('Y-m-d', strtotime($date2));
$transactions = $model->getTransactionsOnDateInterval($_SESSION["user"]["codigo"], $dateStart, $dateEnd, $tipo);

$charts = new Charts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <?php include "src/partials/links.php" ?>
    <title>Extrato de <?= $_SESSION["user"]["nome"]?></title>
</head>

<body>
    <div class="container">
        <h1 class="text-dark py-5 text-center">Extrato de <?= date("d/m/Y", strtotime($date1)) ?> à <?= date("d/m/Y", strtotime($date2)) ?> </h1>
        <div class="row">
            <div class="col">
                <div class="table-responsive mb-4">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Data </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($transactions as $transaction) { ?>
                            <tr>
                                <td><?=$transaction["nome"]?></td>
                                <td><?=$transaction["tipo"] == "gasto" ? "- " : ""?><?=Format::formatMoneyValue($transaction["valor"] /100)?></td>
                                <td><?=date('d/m/Y', strtotime($transaction["data"]))?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php if ($grafico) { ?>
        <div class="container-fluid">
            <div class="col">
                <h2 class="text-dark mb-2 text-center">Gráfico das transações</h2>
                <div style="height: 300px" id="chartContainer">
                </div>
            </div>
        </div>
    <?php } ?>
    <script>
        const chart = new CanvasJS.Chart('chartContainer', {
            animationEnabled: true,
            exportEnabled: false,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            axisY: {
                title: "<?= ucfirst($tipo) ?> (R$)"
            },
            data: [
                {
                    type: "column", //change type to bar, line, area, pie, etc
                    lineColor: "#F2AF5C",
                    markerColor: '#A6702E',
                    toolTipContent: "{name}: <strong>R${y}</strong>",
                    dataPoints: <?= json_encode($charts->getPointsOnDateInterval($tipo, $date1, $date2), JSON_NUMERIC_CHECK); ?>
                },
            ]
        })
        window.addEventListener("load", async () => {
            chart.render()
            setTimeout(() => {
                print()
            }, 1000)
        })
    </script>
</body>

</html>