<?php

  unset($_SESSION["login"]);
  unset($_SESSION["token"]);
  $_SESSION["login"] = "";
  $_SESSION["token"] = "";
  session_destroy();

  echo json_encode(array("sucesso" => 1));
