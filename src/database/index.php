<?php

class Database
{

  private $conn;

  public function Database()
  {
    $username = "root";
    $password = $_ENV['ROOT_PASSWORD'];
    $dbname = $_ENV['DATABASE'];
    $this->conn = new PDO("mysql:host=db;dbname=$dbname", $username, $password);
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function insert($tabela, $dados)
  {
  }

  public function delete($tablea, $id)
  {
  }

  public function select($tabela, $dados, $filtros)
  {
  }

  public function update($tabela, $dados, $filtros)
  {
  }
}
