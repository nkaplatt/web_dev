<?php
  require_once('../resources/requirephp/header.php');
  if (!isset($_SESSION['username'])) {
    header("Location: index.php");
  }
?>

<!-- Header -->
<title>Boat Name</title>
<link rel="stylesheet" type="text/css" href="css/style_sheet.css">
  </head>
  <body class="body">
    <!-- Nav bar for login -->
    <div class="navlogin">
      <a class="logo" href="index.php">FindUrContainer.co.uk</a>
      <?php
      $user_name = "nick";
      require_once('../resources/requirephp/dbc.php');
      login_logout_button($db, $user_name);
      ?>
    </div>

    <!-- Div that center aligns the entire webpage -->
    <div class="centeralign">
      <section class="search">
        <div class="center">
          <?php
          require_once('../resources/requirephp/dbc.php');
          if(isset($_GET['boat'])) {
            $name = $_GET['boat'];
            sql_fetch_data($db, $name);
          } else {
            //header('Location: index.php'); // redirect back to homepage
          }
          $db->close();
          echo '<a href="edit.php?boat='.$name.'">Edit Boat</a>';
          echo '<a href="edit.php?delete='.$name.'">Delete Boat</a>';
          echo '<a href="edit.php?boat=new">Add New Boat</a>';
          ?>
        </div>
      </section>
    </div>

<!-- Footer -->
  </body>
</html>
