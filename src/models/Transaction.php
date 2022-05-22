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
        } catch (PDOException $e) {
            return false;
        }

    }

    public static function listAll($userId) {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM movimentacao WHERE id_usuario= :id ORDER BY data DESC";
        try {
            $numberFormatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);

            $statement = $conn->prepare($sql);
            $statement->execute([
                ":id" => $userId,
            ]);

            $results = array();
            while ($row = $statement->fetchObject('Transaction')) {
                $results[] = $row;
            }

            foreach ($results as $transaction) {
                $transaction->valor = $numberFormatter->formatCurrency($transaction->valor, "BRL");
                $transaction->data = date_format(new DateTime($transaction->data), "d/m");
            }

            return $results;
        } catch (PDOException $e) {
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

    public function delete($id, $userId) {
        $conn = Connection::getConnection();
        $transaction = $this->get($id);

        $sql = "DELETE FROM movimentacao WHERE id = :id";

        if ($transaction->id_usuario != $userId)
            return false;

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
}