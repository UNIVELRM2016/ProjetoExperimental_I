<?php
header('Content-Type: text/html; charset=utf-8');

session_start();

$urlSistema = "http://newrm.polles.me/";

//APIs

$APILogin = "http://newrm.polles.me/JSON/login.php";
$APIVerificaLogin = "http://newrm.polles.me/JSON/verificaLogin.php";
$APIListaContexto = "http://newrm.polles.me/JSON/entidades/contexto/listaContexto.php";
$APIBuscaContexto = "http://newrm.polles.me/JSON/entidades/contexto/buscaContexto.php";

?>
