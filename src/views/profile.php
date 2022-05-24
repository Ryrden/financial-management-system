<?php
if (!isset($_SESSION))
    session_start();
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
    <!-- NAVBAR -->
    <?php include "src/partials/navbar.php" ?>
    <div class="container-fluid py-3">

        <div class="row">
            <?php include "src/partials/menu.php" ?>
            <div class="col-12 col-sm-8 col-lg-9">
                <h1>Meu perfil</h1>
                <div class="row mt-4">
                    <div class="d-flex flex-column align-items-center justify-content-center col-5 primaryContent bg-white rounded-lg mr-4">
                        <?php if ($_SESSION["user"]["nomePerfil"]) { ?>
                        <h2 class="my-3 text-dark text-center"><?= $_SESSION["user"]["nomePerfil"] ?></h2>
                        <img class="my-3" width="100px" src="src/imgs/<?=$_SESSION["user"]["perfilImagem"] ?>.png" alt="<?= $_SESSION["user"]["perfilImagem"] ?>">
                        <p class="text-center text-dark"><?= $_SESSION["user"]["perfilDescricao"]?></p>
                        <?php } else { ?>
                            <p class="text-center text-dark">Responda o questionário para definir seu perfil</p>
                        <?php } ?>
                    </div>
                    <div class="col d-flex flex-column bg-white">
                        <h2 class="text-dark text-center">Gastos e ganhos mensais</h2>
                        <div id="weekInfo" class="mt-2 mb-4 mx-auto button-group">
                            <button data-chart="weeklyGains" class="btn btn-secondary selected">Ganhos</button>
                            <button data-chart="weeklySpends" class="btn btn-secondary">Gastos</button>
                        </div>
                        <div id="pieChartContainer" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
                <div class="row d-flex flex-column p-3 my-3 rounded bg-white">
                    <h2 class=" text-dark text-center">Gastos e ganhos mensais</h2>
                    <div id="transactions" class="my-2 mx-auto button-group">
                        <button data-chart="weeklyTransactions" class="btn btn-secondary selected">Semanal</button>
                        <button data-chart="monthlyTransactions" class="btn btn-secondary">Mensal</button>
                    </div>
                    <div id="lineChartConteiner" style="height: 300px; width: 100%;"></div>
                </div>
                <div class="row d-flex flex-column p-3 my-3 rounded bg-white">
                    <h2 class=" text-dark text-center">Lucros</h2>
                    <div id="profits" class="my-2 mx-auto button-group">
                        <button data-chart="weekProfit" class="btn btn-secondary selected">Semanal</button>
                        <button data-chart="monthProfit" class="btn btn-secondary">Mensal</button>
                    </div>
                    <div id="barChartContainer" style="height: 300px; width: 100%;"></div>

                </div>

            </div>
        </div>

    <script>

        function formatMoneyValue(number) {
            return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(number)
        }

        const configs = {
            weeklyGainsConfig: {
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
                    dataPoints: <?php echo json_encode($charts->getWeeklyGains(), JSON_NUMERIC_CHECK); ?>
                }]
            },
            weeklySpendsConfig: {
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
                    dataPoints: <?php echo json_encode($charts->getWeeklySpends(), JSON_NUMERIC_CHECK); ?>
                }]
            },
            monthProfitConfig: {
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
            },
            weekProfitConfig: {
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
            },
            weeklyTransactionsConfig: {
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
            },
            monthlyTransactionsConfig: {
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
            }
        }

        window.addEventListener("load", () => {
            const transactionsChart = new CanvasJS.Chart("lineChartConteiner", configs.weeklyTransactionsConfig);
            const profitChart = new CanvasJS.Chart("barChartContainer", configs.weekProfitConfig);
            const pieChart = new CanvasJS.Chart("pieChartContainer", configs.weeklyGainsConfig);
            pieChart.render()
            transactionsChart.render()
            profitChart.render()

            const chartModes = [
                {chartContainer: 'lineChartConteiner', buttonContainerId: 'transactions'},
                {chartContainer: 'barChartContainer', buttonContainerId: 'profits'},
                {chartContainer: 'pieChartContainer', buttonContainerId: 'weekInfo'},
            ]
            chartModes.forEach(({chartContainer, buttonContainerId}) => {

                const btnContainer = document.getElementById(buttonContainerId);

                btnContainer.querySelectorAll(`button`).forEach(btn => {
                    btn.addEventListener('click', () => {
                        const chartName = btn.dataset.chart;
                        const chart = new CanvasJS.Chart(chartContainer, configs[`${chartName}Config`]);
                        btnContainer.querySelector(`button.selected`).classList.remove('selected')
                        btn.classList.add('selected')
                        chart.render();
                    })
                });
            })
        })

    </script>
</body>

</html>