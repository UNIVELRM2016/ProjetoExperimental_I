<?php

  include("../../config.php");

  $login = $_POST["login"];
  $senha = $_POST["senha"];

  $sql = "SELECT token, login, senha FROM aluno WHERE login = :p1;";
  $consulta = $conexao->prepare($sql);
  $consulta->bindParam(":p1", $login);
  $consulta->execute();

  if($consulta->rowCount() > 0){
    $usuario = $consulta->fetchAll()[0];
    if($senha == $usuario["senha"]){
        echo json_encode(array("sucesso" => 1, "erro" => 0, "token" => $usuario["token"]));
    }else{
      echo json_encode(array("sucesso" => 0, "erro" => 1, "motivo" => "Login ou senha incorretos."));
    }
  }else{
    echo json_encode(array("sucesso" => 0, "erro" => 1, "motivo" => "Login ou senha incorretos."));
  }
