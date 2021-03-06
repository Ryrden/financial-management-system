<?php

class User
{
    public static function insert($name, $email, $password, $imagem)
    {
        $userWithEmail = self::findUserWithEmail($email);
        $conn = Connection::getConnection();

        $sql = "INSERT INTO usuario (nome, email, senha, imagem) VALUES (:nome, :email, :senha, :image)";

        if (!$userWithEmail["codigo"]) {
            try {
                $statement = $conn->prepare($sql);
                $statement->execute([
                    ":nome" => $name,
                    ":email" => $email,
                    ":senha" => $password,
                    ":image" => $imagem
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

        $sql = "SELECT u.*, p.tipo as nomePerfil, p.descricao as perfilDescricao, p.imagem as perfilImagem, SUM(IF(m.tipo = 'ganho', m.valor, -m.valor)) as renda FROM usuario u LEFT OUTER JOIN perfil p on u.id_perfil = p.id  LEFT OUTER JOIN movimentacao m on u.codigo = m.id_usuario WHERE email = :email";
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

    public function update($userId, $nome, $image, $password) {
        $conn = Connection::getConnection();
        $sql = "UPDATE usuario SET nome = :nome, imagem = :image, senha = :password WHERE codigo = :userId";

        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                ":userId" => $userId,
                ":nome" => $nome,
                ":image" => $image,
                ":password" => $password
            ]);

            return true;
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }
}