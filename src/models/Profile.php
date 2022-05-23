<?php

class Profile
{
    public function setProfile($points, $userId)
    {
        $conn = Connection::getConnection();
        $sqlSelect = "SELECT p.id FROM perfil p WHERE :points BETWEEN pontuacao_min AND pontuacao_max";
        $sqlUpdate = "UPDATE usuario SET id_perfil = :id WHERE codigo = :userId";
        try {
            $statementInsert = $conn->prepare($sqlSelect);
            $statementInsert->execute([
                ":points" => $points,
            ]);
            $profileId = $statementInsert->fetch(PDO::FETCH_ASSOC)["id"];

            $statementUpdate = $conn->prepare($sqlUpdate);
            $statementUpdate->execute([
               ":id" => $profileId,
               ":userId" =>$userId
            ]);
            return true;

        } catch (Exception $e) {
            return false;
        }
    }

    public function getProfile($id) {
        $conn = Connection::getConnection();
        $sql = "SELECT * FROM perfil WHERE id = :id";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                ":id" => $id
            ]);
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }
}