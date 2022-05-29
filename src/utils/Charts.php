<?php
class Charts
{
    private function getLabels($time){
        if ($time == 'week') {
            return ["Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"];
        }
        return ["Janeiro","Fevereiro","Março","Abril","Maio","Junho",
            "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];
    }

    private function getPoints($labels, $time, $function) {
        $points = array();
        $userId = $_SESSION["user"]["codigo"];
        $start = $time == "month" ? 1 : 0;
        $end = $time == "month" ? count($labels) + 1 : count($labels);

        for ($i = $start; $i<$end; $i++) {
            $index = $time == "month" ? $i - 1 : $i;
            $weekTotalValue = $function($i, $userId);
            $points[] = ["y" => $weekTotalValue, "name" => $labels[$index], "label" => $labels[$index]];
        }
        return $points;
    }

    public function getProfit($time) {
        return $this->getPoints($this->getLabels($time), $time, function($i, $userId) use ($time) {
            $transactionsModel = new Transaction();
            if ($time == "month")
                return $transactionsModel->getByMonth($i, $userId);
            else
                return $transactionsModel->getCurrentWeekIncome($i, $userId);
        });
    }

    public function getTransactions($type, $time) {
        return $this->getPoints($this->getLabels($time), $time, function($i, $userId) use ($type, $time) {
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

            $points[] = ["y" => $value, "label" => "Dia ". date('d/m', strtotime($date1)), "name" => "Dia ". date('d/m', strtotime($date1))];
            $date1 = date('Y-m-d', strtotime("+1 days", strtotime($date1)));
        }
        return $points;
    }
}
