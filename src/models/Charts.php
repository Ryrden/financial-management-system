<?php
class Charts
{
    public function yearMoneyService(){
        $dataPoints = array();
        $months = ["Janeiro","Fevereiro","Março","Abril","Maio","Junho",
                        "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];
        
        $transactions = new Transaction();
        $actualUser = $_SESSION["user"]["codigo"];
        for($i = 1; $i <= 12; $i++){
            $monthMoneyService = $transactions->getByMonth($i, $actualUser);
            $currentMonth = $i - 1;
            $data = array("x" => $i, "y"=> $monthMoneyService, "label"=> "$months[$currentMonth]");
            array_push($dataPoints, $data);
        }
        return $dataPoints;
    }

}

?>