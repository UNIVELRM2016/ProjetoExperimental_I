<?php

session_start();

$d = ($d == NULL) ? "./" : $d;

include($d."parametros.php");

//      Função para pegar um JSON enviando um POST

/**
*  make an http POST request and return the response content and headers
*  @param string $url    url of the requested script
*  @param array $data    hash array of request variables
*  @return returns a hash array with response content and headers in the following form:
*    array ('content'=>'<html></html>'
*        , 'headers'=>array ('HTTP/1.1 200 OK', 'Connection: close', ...)
*        )
*  Author: Stas Trefilov
*/
function http_post ($url, $data)
{
    $data_url = http_build_query ($data);
    $data_len = strlen ($data_url);
    // echo $data_url;

    return array ('content'=>file_get_contents ($url, false, stream_context_create (array ('http'=>array ('method'=>'POST'
            , 'header'=>"Connection: close\r\nContent-Length: $data_len\r\n"
            , 'content'=>$data_url
            ))))
        , 'headers'=>$http_response_header
        );
}

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 40px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 40, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}


function consultaContexto(){
  GLOBAL $APIBuscaContexto;
  $contexto = $_SESSION["idContexto"];
  $login = $_SESSION["login"];
  $token = $_SESSION["token"];
  $JSON = http_post($APIBuscaContexto, array("login" => $login, "token" => $token, "idContexto" => $contexto))["content"];
  return json_decode($JSON)->contexto;
}


function listaContextos(){
  GLOBAL $APIListaContexto;
  $login = $_SESSION["login"];
  $token = $_SESSION["token"];
  $JSON = http_post($APIListaContexto, array("login" => $login, "token" => $token))["content"];
  return json_decode($JSON)->contextos;
}
