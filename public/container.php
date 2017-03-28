<?php
  error_reporting(E_ALL);
  require_once('../resources/requirephp/header.php');
?>

<!-- Header -->
<title>Boat Name</title>
<link rel="stylesheet" type="text/css" href="css/style_sheet.css">
  </head>
  <body class="body">
    <!-- Nav bar for login -->
    <div class="navlogin">
      <a class="logo" href="index.php">FindUrContainer.co.uk</a>
      <?php login_logout_button("hey"); ?>
    </div>

    <!-- Div that center aligns the entire webpage -->
    <div class="centeralign">

      <section class="search">
        <p class="center">
          Is this now centered
        </p>
        <div class="center">

          <?php
          require_once('../resources/requirephp/dbc.php');
          $query = "SELECT * FROM `ships_tbl` WHERE 1";
          $result = $db->query($query);

          if ( $result -> num_rows > 0) {
            while ( $row = $result -> fetch_assoc ()) {
              $name = $row ['Boat_Name'];
              $year = $row ['Year_Built'];
              $capacity = $row ['Capacity'];
              $manufactor = $row ['Manufactorer'];
              $operator = $row ['Operator'];
              $img =  $row ['Image'];
            }
          }
          $img = '<img src="img/'.$img.'" alt="AlQibla" class="shipimage" />';
          $name = '<h2 class="name">'.$name.'</h2>';
          $year = '<h3 class="year">'.$year.'</h3>';
          $capacity = '<p class="capacity">'.$capacity.'</p>';
          $manufactor = '<p class="manufactor">'.$manufactor.'</p>';
          $operator = '<p class="operator">'.$operator.'</p>';
          $db->close();
          ?>

          <?php echo $img . $operator. $manufactor. $capacity . $year . $name ;
          ?>
        </div>
        <p class="name">
          hey there
        </p>
      </section>
    </div>

<!-- Footer -->
  </body>
</html>
