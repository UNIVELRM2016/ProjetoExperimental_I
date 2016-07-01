<?php
  session_start();
  $_SESSION["login"] = "";
  $_SESSION["token"] = "";
  session_destroy();

  echo json_encode(array("sucesso" => 1));
