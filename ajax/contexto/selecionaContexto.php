<?php
  $d = "../../";
  include($d."funcoes.php");

  $post["login"] = $_SESSION["login"];
  $post["token"] = $_SESSION["token"];
  $post["idContexto"] = $_POST["idContexto"];

  if($post["login"] != NULL && $post["token"]  != NULL){

    $JSON = http_post($APIListaContexto, $post)["content"];
    // echo($JSON);
    $JSON = json_decode($JSON);
    // print_r($JSON);
    if($JSON->sucesso == 1){
      $idContextoAtual = NULL;
      if($post["idContexto"] == NULL){
        foreach ($JSON->contextos as $inf) {
          if(strtotime($inf->diaInicio) <= time() && strtotime($inf->diaFim) >= time()){
            $idContextoAtual = $inf->idContexto;
          }
        }
      }else{
        $idContextoAtual = $post["idContexto"];
      }
      // echo $idContextoAtual;
      if($idContextoAtual != NULL){
        $_SESSION["idContexto"] = $idContextoAtual;
        echo json_encode(array("sucesso" => 1, "erro" => 0, "selecionarContexto" => 0));
      }else{
        echo json_encode(array("sucesso" => 1, "erro" => 0, "selecionarContexto" => 1));
      }
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
    echo json_encode(array("sucesso" => 0, "erro" => 1, "deslogar" => 1, "motivo" => 1));
  }
