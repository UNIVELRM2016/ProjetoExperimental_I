<?php
  $d = "";
  include("verifica.php");
  // print_r($contexto);
?><!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecionar Contexto - UNIVEL | RM</title>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>

    <div class="row">
      <div class="small-48 medium-48 large-48 columns" id="form">
        <form>
          <h3>Selecionar Contexto Educacional</h3>
          <select id="selecionaContexto">
            <optgroup label="Selecionar Contexto Educacional"></optgroup>
            <option value="0" selected="selected">Selecione...</option>
            <?php
              foreach(listaContextos() as $inf){
                if($inf->isAnual == 0){
                  $nomeContexto = $inf->curso . " " . $inf->ano . "/". $inf->semestre;
                }else{
                  $nomeContexto = $inf->curso . " " . $inf->ano;
                }
                ?>
                <option value="<?php echo $inf->idContexto; ?>"><?php echo $nomeContexto; ?></option><?php
              }
            ?>
          </select>
        </form>
      </div>
    </div>

    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/what-input/what-input.js"></script>
    <script src="bower_components/foundation-sites/dist/foundation.js"></script>
    <script src="js/app.js"></script>
    <script src="js/login.js"></script>
  </body>
</html>
