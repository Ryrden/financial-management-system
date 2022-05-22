<?php

class TransactionController
{
    public function insert($params) {
        UserController::mustBeLoggedIn();

        if (!isset($_SESSION)) {
            session_start();
        }

        $transactionsModel = new Transaction();
        $date = date('Y-m-d', strtotime($_POST['data']));
        $value = $_POST['valor'] * 100;
        $name = $_POST['nome'];
        $type = $_POST['tipo'];
        $userId = $_SESSION["user"]["codigo"];

        try {
            $inserted = $transactionsModel->insert($date, $value, $name, $type, $userId);
            if ($inserted)
                echo "<script>alert('Transação adicionada com sucesso'); location.href='".BASE_URL."'</script>";
            else
                echo "<script>alert('Erro ao inserir transação'); location.href=".BASE_URL."</script>";

        } catch (Exception $e) {
            echo "<script>alert('Unhandled server error'); location.href=".BASE_URL."</script>";
        }
    }

    public function delete($id) {
        UserController::mustBeLoggedIn();
        if (!isset($_SESSION))
            session_start();
        try {
            $transactionsModel = new Transaction();
            $transaction = $transactionsModel->get($id);

            if ($transaction->id_usuario == $_SESSION["user"]["codigo"])
                $deleted = $transactionsModel->delete($id, $_SESSION["user"]["codigo"]);
            else
                $deleted = false;

            if ($deleted) {
                echo "<script>alert('Movimentação deletada com sucesso'); location.href='".BASE_URL."'</script>";
            } else {
                echo "<script>alert('Erro ao deletar movimentação'); location.href='".BASE_URL."'</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('Unhandled server error'); location.href='".BASE_URL."'</script>";
        }

    }

    public function update($params) {
        UserController::mustBeLoggedIn();
        if (!isset($_SESSION))
            session_start();
        try {
            $transactionsModel = new Transaction();

            $id = $_POST['id'];
            $date = $_POST['data'];
            $value = $_POST['valor'];
            $name = $_POST['nome'];
            $type = $_POST['tipo'];

            $transaction = $transactionsModel->get($id);

            if ($transaction->id_usuario == $_SESSION["user"]["codigo"])
                $updated = $transactionsModel->update($id, $date, $value, $name, $type);
            else
                $updated = false;


            if ($updated) {
                echo "<script>alert('Update completo'); location.href='".BASE_URL."'</script>";
            } else {
                echo "<script>alert('Erro no update'); location.href='".BASE_URL."'</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('Unhandled server error'); location.href='".BASE_URL."'</script>";
        }


    }

}