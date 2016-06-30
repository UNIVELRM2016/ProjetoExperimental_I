<?php
  include($d."funcoes.php");

  session_start();
  $login = $_SESSION["login"];
  $token = $_SESSION["token"];

  if($login != NULL && $token != NULL){
      $JSON = http_post($APIVerificaLogin, array("login" => $login, "token" => $token))["content"];
      $JSON = json_decode($JSON);
      if($JSON->deslogado == 1){
        unset($_SESSION["login"]);
        unset($_SESSION["token"]);
        session_destroy();
        header("location: ".$urlSistema."login.html?m=1");
      }
  }else{
    unset($_SESSION["login"]);
    unset($_SESSION["token"]);
    session_destroy();
    header("location: ".$urlSistema."login.html?m=2");
  }
