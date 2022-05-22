<?php

class UserController
{
    public function register($params) {
        $name = $_POST['name'];
        $email= $_POST['email'];
        $password = $_POST['password'];

        try {
            User::insert($name, $email, $password);
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
}