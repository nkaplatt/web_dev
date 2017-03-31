<?php
  $db = new mysqli("localhost",
    "nick",
    "mac133",
    "ecm2422_db");
    if (mysqli_connect_errno()) {
      die("Error connecting to database : "
      . mysqli_connect_errno());
    }
?>
