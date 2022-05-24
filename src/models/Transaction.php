<?php

class Transaction
{
    public function insert($date, $value, $name, $type, $userId) {
        $conn = Connection::getConnection();

        $sql = "INSERT INTO movimentacao (data, valor, nome, tipo, id_usuario) VALUES (:date, :value, :name, :type, :userId)";

        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                ":date" => $date,
                ":value" => $value,
                ":name" => $name,
                ":type" => $type,
                ":userId" => $userId
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }

    }

    public static function list($userId, $amountOfTransactions) {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM movimentacao WHERE id_usuario= :id ORDER BY data DESC LIMIT $amountOfTransactions";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                ":id" => $userId,
            ]);

            $results = array();
            while ($row = $statement->fetchObject('Transaction')) {
                $results[] = $row;
            }

            foreach ($results as $transaction) {
                $transaction->formattedValor = Format::formatMoneyValue($transaction->valor / 100);
                $transaction->formattedData = date_format(new DateTime($transaction->data), "d/m");
            }

            return $results;
        } catch (PDOException $e) {
            echo $e;
            return [];
        }
    }

    public function get($id) {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM movimentacao WHERE id = :id";

        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                ":id" => $id
            ]);
            return $statement->fetchObject('Transaction');
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getByMonth($_month,$userId) {
        $conn = Connection::getConnection();

        $sql = "SELECT SUM(IF(tipo = 'ganho', valor, -valor)) as moneyService 
                        FROM movimentacao 
                        WHERE month(data) = :_month
                        AND id_usuario = :userId";

        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                ":_month" => $_month,
                ":userId" => $userId
            ]);
            return  ((float) $statement->fetch()["moneyService"] / 100);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id, $userId) {
        $conn = Connection::getConnection();
        $transaction = $this->get($id);

        $sql = "DELETE FROM movimentacao WHERE id = :id";

        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                ":id" => $id
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($id, $date, $value, $name, $type) {
        $conn = Connection::getConnection();

        $sql = "UPDATE movimentacao SET data = :date, valor = :value, nome = :name, tipo = :type WHERE id = :id";

        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                ":date" => $date,
                ":value" => $value,
                ":name" => $name,
                ":type" => $type,
                ":id" => $id
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }

    }

    public function getCurrentWeekIncome($mysqlWeekday, $userId) {
        $conn = Connection::getConnection();
        $sql = "SELECT SUM(IF(tipo = 'ganho', m.valor, -m.valor)) as total FROM movimentacao m 
                            WHERE WEEKDAY(m.data) = :weekday AND WEEK(m.data) = WEEK(NOW()) AND id_usuario = :id";

        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                ":id" => $userId,
                ":weekday" => $mysqlWeekday,
            ]);
            return $statement->fetch(PDO::FETCH_ASSOC)["total"] / 100;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getMonthTransactions($month, $userId, $type) {
        $conn = Connection::getConnection();
        $sql = "SELECT SUM(IF(tipo = :type, m.valor, 0)) as total FROM movimentacao m where id_usuario = :id AND MONTH(m.data) = :month";

        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                ":id" => $userId,
                ":type" => $type,
                ":month" => $month,
            ]);
            return $statement->fetch(PDO::FETCH_ASSOC)["total"] / 100;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getWeekTransactions($weekday, $userId, $type) {
        $conn = Connection::getConnection();
        $sql = "SELECT SUM(IF(tipo = :type, m.valor, 0)) as total FROM movimentacao m where id_usuario = :id AND WEEKDAY(m.data) = :weekday AND WEEK(m.data) = WEEK(NOW())";

        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                ":id" => $userId,
                ":type" => $type,
                ":weekday" => $weekday,
            ]);
            return $statement->fetch(PDO::FETCH_ASSOC)["total"] / 100;
        } catch (Exception $e) {
            return false;
        }
    }

}