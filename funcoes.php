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


function consultaContexto(){
  $contexto = $_SESSION["contexto"];
  return $contexto;
}
