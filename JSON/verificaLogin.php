<?php

  include("../config.php");

  $login = $_POST["login"];
  $token = $_POST["token"];

  $sql = "SELECT usuario FROM aluno WHERE usuario = :p1 && token = :p2;";
  $consulta = $conexao->prepare($sql);
  $consulta->bindParam(":p1", $login);
  $consulta->bindParam(":p2", $token);
  $consulta->execute();

  if($consulta->rowCount() > 0){
    echo json_encode(array("sucesso" => 1, "erro" => 0));
  }else{
    echo json_encode(array("sucesso" => 0, "erro" => 0, "deslogado" => 1));
  }
