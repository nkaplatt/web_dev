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
            ?>
            <form method="post" enctype="multipart/form-data">
              <input class="editbar" id="name" name="name" type="text" placeholder="Name"/> <br />
              <input class="editbar" id="year" name="year" type="text" placeholder="Capacity"/> <br />
              <input class="editbar" id="capacity" name="capacity" type="text" placeholder="Year"/><br />
              <input class="editbar" id="operator" name="operator" type="text" placeholder="Manufacturer"/><br />
              <input class="editbar" id="manufactorer" name="manufactorer" type="text" placeholder="Operator"/><br />
              <input class="file" type="file" name="image" id="image"> <br />
              <input type="submit" class="editsubmit" name="submit">
            </form> <?php
            if ($name == 'new') { ?>
              <script>
                $(document).ready(function (){
                    edit_form_filled();
                    $('#name, #year, #capacity, #operator, #manufactorer, #image').change(edit_form_filled);
                });
              </script>
              <?php
              if(isset($_POST['submit'])) {
                $name = $db->real_escape_string($_POST['name']);
                $year = $db->real_escape_string($_POST['year']);
                $capacity = $db->real_escape_string($_POST['capacity']);
                $operator = $db->real_escape_string($_POST['operator']);
                $manufactorer = $db->real_escape_string($_POST['manufactorer']);
                $file = basename($_FILES["image"]["name"]);
                require_once('upload.php');
              }
            } else {
              $boat = $_GET['boat'];
              $ID = fetch_ID($db, $boat);
              if(isset($_POST['submit'])) {
                if (($_POST['name']) != '') {$name = $db->real_escape_string($_POST['name']); edit_name($db, $name, $ID);}
                if (($_POST['year']) != '') {$year = $db->real_escape_string($_POST['year']); edit_year($db, $year, $ID);}
                if (($_POST['capacity']) != '') {$capacity = $db->real_escape_string($_POST['capacity']); edit_capacity($db, $capacity, $ID);}
                if (($_POST['operator']) != '') {$operator = $db->real_escape_string($_POST['operator']); edit_operator($db, $operator, $ID);}
                if (($_POST['manufactorer']) != '') {$manufactorer = $db->real_escape_string($_POST['manufactorer']); edit_manufactorer($db, $manufactorer, $ID);}
                if (($_FILES["image"]["name"])  != '' ) {$file = basename($_FILES["image"]["name"]); edit_image($db, $file, $ID); require_once('uploadedit.php');}
              //  else {header("Location: container.php?boat=Alma".$boat);}
              }
            }
          } else if (isset($_GET['delete'])) {
            $name = $_GET['delete'];
            echo '<div class="delete"><h2>Are you sure you want to delete the boat <br />'.
            $name .' from the database? <br />This action is not reversible.</h2>';
            echo '<button class="button" id="deleteboat" name="boat" value="'.$name.'" onclick="delete_ship(this.value)">confirm</button>';
            echo '<a class="button" href="container.php?boat='.$name.'">cancel</a>';
            ?></div><?php
          } else {
            header('Location: index.php'); // redirect back to homepage
          }
          $db->close();
          ?>
        </div>
      </section>
    </div>

<!-- Footer -->
  </body>
</html>
