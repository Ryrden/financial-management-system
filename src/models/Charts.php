<?php
class Charts
{
    private function getMonthPoints($function){
        $dataPoints = array();
        $months = ["Janeiro","Fevereiro","Março","Abril","Maio","Junho",
                        "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];

        $transactions = new Transaction();
        $actualUser = $_SESSION["user"]["codigo"];
        for($i = 1; $i <= 12; $i++){
            $monthMoneyService = $function($i, $actualUser);
            $currentMonth = $i - 1;
            $data = array("x" => $i, "y"=> $monthMoneyService, "label"=> "$months[$currentMonth]", "name" => $months[$currentMonth]);
            $dataPoints[] = $data;
        }
        return $dataPoints;
    }

    private function getWeekPoints($function) {
        $points = array();
        $userId = $_SESSION["user"]["codigo"];
        $weekdays = ["Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"];

        for ($i = 0; $i<count($weekdays); $i++) {
            $weekTotalValue = $function($i, $userId);
            $points[] = ["y" => $weekTotalValue, "name" => $weekdays[$i], "label" => $weekdays[$i]];
        }
        return $points;
    }

    public function getProfit($type) {
        return $this->getMonthPoints(function($i, $userId) use ($type) {
            $transactionsModel = new Transaction();
            if ($type == "month")
                return $transactionsModel->getByMonth($i, $userId);
            else
                return $transactionsModel->getCurrentWeekIncome($i, $userId);
        });
    }

    public function getTransactions($type, $time) {
        return $this->getWeekPoints(function($i, $userId) use ($type, $time) {
            $transactionsModel = new Transaction();
            if ($time == "week")
                return $transactionsModel->getWeekTransactions($i, $userId,$type);
            else
                return $transactionsModel->getMonthTransactions($i, $userId, $type);
        });
    }

    public function getPointsOnDateInterval($type, $date1, $date2) {
        $model = new Transaction();
        $points = array();
        $userId = $_SESSION["user"]["codigo"];
        while (strtotime($date1) <= strtotime($date2)) {
            if ($type == 'ganho' || $type == 'gasto')
                $value = $model->getTransactionstOnDate($userId, $date1, $type);
            else
                $value = $model->getProfitOnDate($userId, $date1);

            $points[] = ["x" => (int) date("d", strtotime($date1)), "y" => $value, "label" => "Dia ". date('d/m', strtotime($date1))];
            $date1 = date('Y-m-d', strtotime("+1 days", strtotime($date1)));
        }
        return $points;
    }
}
