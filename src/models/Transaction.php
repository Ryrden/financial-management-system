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
                $transaction->formattedValor = $numberFormatter->formatCurrency($transaction->valor, "BRL");
                $transaction->formattedData = date_format(new DateTime($transaction->data), "d/m");
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
}