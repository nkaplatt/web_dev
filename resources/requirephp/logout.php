<?php
  require_once("queryfunctions.php");
  sql_sign_out($user_name, $db);
  header('Location: index.php');
  exit;
 ?>
