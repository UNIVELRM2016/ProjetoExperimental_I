<?php
  $d = "";
  include("verifica.php");
  $contexto = consultaContexto();
  // print_r($contexto);
?><!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - UNIVEL | RM</title>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="bower_components/foundation-icon-fonts/foundation-icons.css">
  </head>
  <body>
    <header>
      <div class="top-bar">
        <div class="top-bar-left">
          <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text"></li>
            <li><a href="<?php echo $urlSistema; ?>"><img src="<?php echo $urlSistema; ?>img/logoBranco.svg" id="logo"></a></li>
            <!-- <li>
              <a href="#">One</a>
              <ul class="menu vertical">
                <li><a href="#">One</a></li>
                <li><a href="#">Two</a></li>
                <li><a href="#">Three</a></li>
              </ul>
            </li> -->
          </ul>
        </div>
        <div class="top-bar-right">
          <ul class="dropdown menu" data-dropdown-menu>
            <li><a href="/selecionarContexto.php"><i class="fi-book"></i> <?php echo $contexto->curso . " " . $contexto->ano . "/" . $contexto->semestre; ?></a></li>
            <li>
              <a href="#"><i class="fi-torso"></i> <?php echo $contexto->nomeAluno; ?> <img src="<?php echo get_gravatar($contexto->emailAluno); ?>" id="avatar"></a>
              <ul class="menu vertical">
                <li><a>RA: <?php echo $contexto->raAluno; ?></a></li>
                <li><a id="sair">Sair</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </header>

    <div class="row">
      <div class="small-48 medium-48 large-48 columns">

      </div>
    </div>

    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/what-input/what-input.js"></script>
    <script src="bower_components/foundation-sites/dist/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
