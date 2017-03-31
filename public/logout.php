<?php
  session_start();
  require_once("../resources/requirephp/queryfunctions.php");
  require_once("../resources/requirephp/dbc.php");
  if (isset($_SESSION['username'])) {
    sql_sign_out($_SESSION['username'], $db);
    unset ($_SESSION['username']);
  }
  header('Location: index.php');
  exit;
 ?>
