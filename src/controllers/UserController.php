<?php

class UserController
{
    public function register($params) {
        $name = $_POST['name'];
        $email= $_POST['email'];
        $password = $_POST['password'];

        try {
            User::insert($name, $email, $password);
            echo "<script>
                alert('Usuário cadastrado com sucesso!')
                location.href='http://localhost/financial-management-system/index.php/login';
            </script>";

        } catch (Exception $e) {
            echo "<script>
                alert('".$e->getMessage()."')
                location.href='http://localhost/financial-management-system/index.php/cadastro';
            </script>";
        }
    }

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        try {
            $user = User::findUserWithEmail($email);
            if (!$user OR $user['senha'] != $password) {
                echo "<script>
                alert('Credenciais incorretas')
                location.href='http://localhost/financial-management-system/index.php/login';
            </script>";
            } else {
                echo "<script>
                location.href='http://localhost/financial-management-system/index.php/';
            </script>";
            }
        } catch (Exception $e) {
            echo "<script>
                alert('".$e->getMessage()."')
                location.href='http://localhost/financial-management-system/index.php/login';
            </script>";
        }

    }
}