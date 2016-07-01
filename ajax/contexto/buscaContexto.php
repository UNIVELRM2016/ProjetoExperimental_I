<?php
  $d = "../../";
  include($d."funcoes.php");

  $login = $_SESSION["login"];
  $token = $_SESSION["token"];

  $idContexto = $_POST["idContexto"];

  if($login != NULL && $token != NULL && $idContexto != NULL){

    $JSON = http_post($APIBuscaContexto, array("login" => $login, "token" => $token, "idContexto" => $idContexto))["content"];
    // echo($JSON);
    $JSON = json_decode($JSON);
    // print_r($JSON);
    if($JSON->sucesso == 1){
      return json_encode($JSON->contexto);
    }elseif($JSON->erro == 1 && $JSON->null == 0){
      unset($_SESSION["token"]);
      session_destroy();
      echo json_encode(array("sucesso" => 0, "erro" => 1, "deslogar" => 1, "motivo" => 0));
    }else{
      unset($_SESSION["token"]);
      session_destroy();
      echo json_encode(array("sucesso" => 0, "erro" => 1, "motivo" => "Algo deu errado. Por favor, tente novamente."));
    }
  }else{
    echo json_encode(array("sucesso" => 0, "erro" => 1, "selecionarContexto" => 1, "motivo" => 1));
  }
