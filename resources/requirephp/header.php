<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style_sheet.css"/>
  <script type="text/javascript" src="js/function.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <link rel="SHORTCUT ICON" href="../resources/favicon.ico"/>

<!-- require php functions for pages -->
<?php
  session_start();
  require_once("../resources/requirephp/functions.php");
  require_once("../resources/requirephp/queryfunctions.php");
  if (!isset($_SESSION['username'])) {
    $username = '';
  } else {
    $username = $_SESSION['username'];
  }
 ?>
