<?php

class UserController
{
    public function register($params) {
        $name = $_POST['name'];
        $email= $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $image = 'https://res.cloudinary.com/davifelix/image/upload/v1653580469/user_kyeqca.png';

        try {
            User::insert($name, $email, $hashedPassword, $image);
            echo "<script>alert('Usuário cadastrado com sucesso!'); location.href='".BASE_URL."/login"."'; </script>";

        } catch (Exception $e) {
            echo "<script> alert('".$e->getMessage()."'); location.href='".BASE_URL."/cadastro"."'; </script>";
        }
    }

    public function login() {
        session_start();
        $email = $_POST['email'];
        $password = $_POST['password'];
        try {
            $user = User::findUserWithEmail($email);
            $user['senha'] = password_verify($password, $user['senha']);
            if (!$user OR $user['senha'] != $password) {
                echo "<script> alert('Credenciais incorretas'); location.href='".BASE_URL."/login"."'; </script>";
            } else {
                $_SESSION['user'] = $user;
                echo "<script> location.href='".BASE_URL."'; </script>";
            }
        } catch (Exception $e) {
            echo "<script> alert('".$e->getMessage()."'); location.href='".BASE_URL."/login"."'; </script>";
        }

    }

    public function logout() {
        session_start();
        unset($_SESSION['user']);
        echo "<script> location.href='".BASE_URL."/login"."'; </script>";
    }

    public static function mustBeLoggedIn() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!$_SESSION["user"]["codigo"]) {
            $loginUrl = BASE_URL."/login";
            echo "<script>location.href='$loginUrl'</script>";
        }
    }

    public static function refreshUser($email) {
        try {
            if (!isset($_SESSION))
                session_start();
            $user = User::findUserWithEmail($email);
            $_SESSION['user'] = $user;
        } catch (Exception $e) {
            echo "<script> location.href='".BASE_URL."/login"."'; </script>";
        }
    }

    public function update() {
        try {
            self::mustBeLoggedIn();
            $model = new User();
            $id = $_SESSION["user"]["codigo"];
            $nome = $_POST["nome"];

            $imageName = $_FILES["image"]["tmp_name"];
            $imageSize = $_FILES["image"]["size"];
            if (!empty($imageName)) {
                $uploader = new Upload();
                $response = $uploader->uploadImage($imageName, $imageSize);
                if (!$response)
                    throw new Exception("Error uploading image");
                $image = $response["url"];
            } else {
                $image = $_SESSION["user"]["imagem"];
            }
            $password = $_POST["password"];
            $model->update($id, $nome, $image, empty($password) ? $_SESSION["user"]["senha"] : $password);
            echo "<script>location.href='".BASE_URL."/profile"."'</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erro ao atualizar perfil'); location.href='".BASE_URL."'</script>";
        }
    }
}