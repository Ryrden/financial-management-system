<?php
if (!isset($_SESSION))
    session_start();
$transactions = Transaction::listAll($_SESSION["user"]["codigo"]);
$charts = new Charts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js" async></script>

    <?php include "src/partials/links.php" ?>
    <title>Perfil | Sistema de Gestão Financeira</title>
</head>

<body>
<div class="container-fluid bg-half">
    <!-- Modal -->
    <div class="container-fluid py-3">

        <!-- NAVBAR -->
        <?php include "src/partials/navbar.php" ?>
        <!-- CONTENT -->
        <?php include "src/partials/menu.php" ?>
            <!-- Segunda coluna -->
            <div class="container col-md-9">
                <h1>Meu perfil</h1>
                <div class="row mt-4 d-flex align-items-center">
                    <div class="d-flex flex-column align-items-center col-4 primaryContent bg-white rounded-lg mr-4">
                        <h2 class="my-3 text-dark text-center"><?= $_SESSION["user"]["nomePerfil"] ?></h2>
                        <img class="my-3" width="100px" src="src/imgs/<?=$_SESSION["user"]["perfilImagem"] ?>.png" alt="<?= $_SESSION["user"]["perfilImagem"] ?>">
                        <p class="text-center text-dark"><?= $_SESSION["user"]["perfilDescricao"]?></p>
                    </div>
                    <div class="col-7 bg-white">
                        <h2 class="my-3 text-dark text-center">Lucros semanais</h2>
                        <div id="weekChartContainer" style="height: 300px; width: 100%;"></div>
                        <p class="text-center text-dark">Soma dos gastos e ganhos na semana</p>
                    </div>
                </div>
                <div class="row mt-4 mx-auto d-flex align-items-center justify-content-center">
                    <h2 class="my-3 text-dark text-center">Gastos e ganhos mensais</h2>
                    <div id="gastosGanhosMensais" style="height: 300px; width: 100%;"></div>
                </div>
                <div class="row mt-4 mx-auto d-flex align-items-center justify-content-center">
                    <h2 class="my-3 text-dark text-center">Gastos e ganhos semanais</h2>
                    <div id="gastosGanhosSemanais" style="height: 300px; width: 100%;"></div>
                </div>
                <div class="container col-md-9 bg-white">
                    <h2 class="my-3 text-dark text-center">Lucros semanais</h2>
                    <div id="weekIncomeChartContainer" style="height: 300px; width: 100%;">
                    </div>
                    <p class="text-center text-dark">Soma dos gastos e ganhos em cada dia da semana</p>
                </div>
                <div class="container col-md-9 bg-white">
                    <h2 class="my-3 text-dark text-center">Lucros mensais</h2>
                    <div id="yearChartContainer" style="height: 300px; width: 100%;">
                    </div>
                    <p class="text-center text-dark">Soma dos gastos e ganhos em cada mês do ano</p>
                </div>

            </div>
        </div>

    <script>

        function formatMoneyValue(number) {
            return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(number)
        }

        function renderCharts() {
            const charts = [
                new CanvasJS.Chart("weekChartContainer", {
                    animationEnabled: true,
                    exportEnabled: false,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    legend: {
                        horizontalAlign: "left",
                        verticalAlign: "top"
                    },
                    data: [{
                        type: "pie", //change type to bar, line, area, pie, etc
                        showInLegend: true,
                        toolTipContent: "{name}: <strong>R${y}</strong>",
                        indexLabelPlacement: "outside",
                        dataPoints: <?php echo json_encode($charts->getWeekDayIncomePoints(), JSON_NUMERIC_CHECK); ?>
                    }]
                }),
                new CanvasJS.Chart("yearChartContainer", {
                    animationEnabled: true,
                    exportEnabled: false,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    axisY: {
                        title: "Valor em lucro (R$)"
                    },
                    axisX: {
                        title: "Mês do ano"
                    },
                    data: [
                        {
                            type: "column", //change type to bar, line, area, pie, etc
                            lineColor: "#F2AF5C",
                            markerColor: '#A6702E',
                            toolTipContent: "{name}: <strong>R${y}</strong>",
                            dataPoints: <?php echo json_encode($charts->getMonthIncomePoints(), JSON_NUMERIC_CHECK); ?>
                        }
                    ]
                }),
                new CanvasJS.Chart("weekIncomeChartContainer", {
                    animationEnabled: true,
                    exportEnabled: false,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    axisY: {
                        title: "Valor em lucro (R$)"
                    },
                    axisX: {
                        title: "Mês do ano"
                    },
                    data: [{
                        type: "column", //change type to bar, line, area, pie, etc
                        lineColor: "#F2AF5C",
                        markerColor: '#A6702E',
                        toolTipContent: "{name}: <strong>R${y}</strong>",
                        dataPoints: <?php echo json_encode($charts->getWeekDayIncomePoints(), JSON_NUMERIC_CHECK); ?>
                    }]
                }),
                new CanvasJS.Chart("gastosGanhosSemanais", {
                    animationEnabled: true,
                    exportEnabled: false,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    axisY: {
                        title: "Valor em lucro (R$)"
                    },
                    axisX: {
                        title: "Dia da semana"
                    },
                    data: [
                        {
                            type: "line", //change type to bar, line, area, pie, etc
                            lineColor: "red",
                            markerColor: 'red',
                            toolTipContent: "{name}: <strong>R${y}</strong>",
                            dataPoints: <?php echo json_encode($charts->getWeeklySpends(), JSON_NUMERIC_CHECK); ?>
                        },
                        {
                            type: "line", //change type to bar, line, area, pie, etc
                            lineColor: "green",
                            markerColor: 'green',
                            toolTipContent: "{name}: <strong>R${y}</strong>",
                            dataPoints: <?php echo json_encode($charts->getWeeklyGains(), JSON_NUMERIC_CHECK); ?>
                        },
                    ]
                }),
                new CanvasJS.Chart("gastosGanhosMensais", {
                    animationEnabled: true,
                    exportEnabled: false,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    axisY: {
                        title: "Valor em lucro (R$)"
                    },
                    axisX: {
                        title: "Mês do ano"
                    },
                    data: [
                        {
                            type: "line", //change type to bar, line, area, pie, etc
                            lineColor: "red",
                            markerColor: 'red',
                            toolTipContent: "{name}: <strong>R${y}</strong>",
                            dataPoints: <?php echo json_encode($charts->getMonthlySpends(), JSON_NUMERIC_CHECK); ?>
                        },
                        {
                            type: "line", //change type to bar, line, area, pie, etc
                            lineColor: "green",
                            markerColor: 'green',
                            toolTipContent: "{name}: <strong>R${y}</strong>",
                            dataPoints: <?php echo json_encode($charts->getMonthlyGains(), JSON_NUMERIC_CHECK); ?>
                        },
                    ]
                })
            ]
           charts.map(chart => chart.render());

        }
        window.onload = renderCharts;
    </script>
</body>

</html>