<?php

class Questionario
{
    public function getQuestions($id) {
        $conn = Connection::getConnection();
        $sql = "SELECT p.texto, p.id FROM pergunta p WHERE id_questionario = :id";
        $mappedQuestions = [];
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ":id" => $id
            ]);
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($questions as $question) {
                $questionId = $question["id"];

                $sql = "SELECT a.texto, a.pontuacao, CONCAT('$questionId', a.id) as id FROM alternativa a WHERE a.id_pergunta = :id_pergunta";
                $alternativesStmt = $conn->prepare($sql);
                $alternativesStmt->execute([
                    ":id_pergunta" => $questionId,
                ]);
                $question["alternatives"] = $alternativesStmt->fetchAll(PDO::FETCH_ASSOC);
                $mappedQuestions[] = $question;
            }

            return $mappedQuestions;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}