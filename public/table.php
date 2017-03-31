<?php
if(isset($_GET['table'])) {

  require_once('../resources/requirephp/dbc.php');

  $company = $_GET["table"];

  $query = "SELECT Boat_Name, Capacity FROM `Ships_tbl` WHERE Manufacturer = '{$company}';";
  $result = $db->query($query);

  if ($result -> num_rows > 0) {
    echo '<table class="summary">
      <tr>
        <th>Name</th>
        <th>Capacity</th>
        <th>Page</th>
      </tr>';
    while ( $row = $result -> fetch_assoc()) {
      $name = $row ['Boat_Name'];
      $capacity = $row ['Capacity'];
      echo '<tr><th>';
      echo $name . '</th>';
      echo '<th>'.$capacity.'</th>';
      echo '<th><a class="link" href="container.php?boat='.$name.'">link</a></th>';
      echo '</tr>';
    }
    echo "</table>";
  }

  $db->close();
} else {
  header('Location: index.php');
}
?>
