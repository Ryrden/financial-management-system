<?php

class User
{
    public static function insert($name, $email, $password)
    {
        $userWithEmail = self::findUserWithEmail($email);
        $conn = Connection::getConnection();

        $sql = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";

        if (!$userWithEmail) {
            try {
                $statement = $conn->prepare($sql);
                $statement->execute([
                    ":nome" => $name,
                    ":email" => $email,
                    ":senha" => $password,
                ]);
            } catch (PDOException $e) {
                throw new Exception("Erro ao inserir");
            } catch (Exception $e) {
                throw new Exception("Unhandled server error");
            }
        } else {
            throw new Exception("Email já cadastrado");
        }

    }

    public static function findUserWithEmail($email) {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM usuario WHERE email = :email";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                "email" => $email,
            ]);

            return $statement->fetch();
        } catch (PDOException $e) {
            throw new Exception("Erro ao encontrar usuário");
        } catch (Exception $e) {
            throw new Exception("Unhandled server error");
        }
    }

}