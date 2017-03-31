<?php
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
}
if(isset($_GET['delete'])) {

  require_once('../resources/requirephp/dbc.php');

  $name = $_GET["delete"];

  $query = "DELETE FROM `Ships_tbl` WHERE Boat_Name = '{$name}'";
  $result = $db->query($query);

  if (mysqli_affected_rows($db) > 0) {
    echo 'Successfuly deleted ' . $name . ' from the database';
    header('Location: index.php');
  }
  $db->close();
} else {
  header('Location: index.php');
}
?>
