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

    public function getWeekProfit() {
        return $this->getWeekPoints(function($i, $userId) {
            $transactionsModel = new Transaction();
            return $transactionsModel->getCurrentWeekIncome($i, $userId);
        });
    }

    public function getWeekGains() {
        return $this->getWeekPoints(function($i, $userId) {
            $transactionsModel = new Transaction();
            return $transactionsModel->getWeekTransactions($i, $userId,"ganho");
        });
    }

    public function getWeekSpends() {
        return $this->getWeekPoints(function($i, $userId) {
            $transactionsModel = new Transaction();
            return $transactionsModel->getWeekTransactions($i, $userId,"gasto");
        });
    }

    public function getMonthProfit() {
        return $this->getMonthPoints(function($i, $userId) {
            $transactionsModel = new Transaction();
            return $transactionsModel->getByMonth($i, $userId);
        });
    }

    public function getMonthGains() {
        return $this->getMonthPoints(function($i, $userId) {
            $transactionsModel = new Transaction();
            return $transactionsModel->getMonthTransactions($i, $userId,"ganho");
        });
    }

    public function getMonthSpends() {
        return $this->getMonthPoints(function($i, $userId) {
            $transactionsModel = new Transaction();
            return $transactionsModel->getMonthTransactions($i, $userId,"gasto");
        });
    }

}

?>