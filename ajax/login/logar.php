<?php
  $d = "../../";
  include($d."funcoes.php");

  $login = $_POST["login"];
  $senha = $_POST["senha"];

  if($login != NULL && $senha != NULL){

    $JSON = http_post($APILogin, array("login" => $login, "senha" => $senha))["content"];
    $JSON = json_decode($JSON);
    //  print_r($JSON);
    if($JSON->sucesso == 1){
      $_SESSION["token"] = $JSON->token;
      echo json_encode(array("sucesso" => 1, "erro" => 0));
    }elseif($JSON->erro == 1){
      isset($_SESSION["token"]);
      session_destroy();
      echo json_encode(array("sucesso" => 0, "erro" => 1, "motivo" => $JSON->motivo));
    }else{
      isset($_SESSION["token"]);
      session_destroy();
      echo json_encode(array("sucesso" => 0, "erro" => 1, "motivo" => "Algo deu errado. Por favor, tente novamente."));
    }
  }else{
    echo json_encode(array("sucesso" => 0, "erro" => 1, "motivo" => "O login e/ou a senha estão nulos. Preencha-os e tente novamente."));
  }
