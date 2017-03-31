<?php

function sign_in($db) {
  $username = $db->real_escape_string($_POST["username"]);
  $unsalted = $db->real_escape_string($_POST["password"]);

  // encrypt password & fetch salt
  $string = fetch_salt($db, $username);
  $password = $unsalted . $string; // add unique salt
  $password = hash('sha256', $password); // hash password
  if (sql_sign_in($username, $password, $db) == 0) {
    echo "<p class=\"errorlogin\">Could not log in, username or password incorrect</p>";
  } else {
    return 1;
  }
}

function is_user_logged_in($db, $user_ID) {
	$query = "SELECT * FROM User_tbl WHERE User_Name = '{$user_ID}' AND Logged_IN = '1';";
	$result = $db->query($query);
	if (mysqli_num_rows($result) == 0) {
		return false;
	} else {
		return true;
	}
}

function is_logged_in() {

}

function sql_sign_in($username, $password, $db) {
  $query = "UPDATE User_tbl SET Logged_IN = '1' WHERE User_Name = '{$username}' AND User_Password = '{$password}'";
  $result = $db->query($query);
  return mysqli_affected_rows($db);
}

function sql_sign_out($username, $db) {
  $query = "UPDATE User_tbl SET Logged_IN = '0' WHERE User_Name = '{$username}'";
  $result = $db->query($query);
  return $result;
}

function fetch_salt($db, $username) {
  $query = "SELECT Salt FROM `user_tbl` WHERE User_Name = '{$username}'";
  $result = $db->query($query);

  if ($result -> num_rows > 0) {
    while ( $row = $result -> fetch_assoc ()) {
      $string = $row ['Salt'];
      return $string;
    }
  }
}

function sign_up($db) {
  $username = $db->real_escape_string($_POST["username"]);
  $unsalted = $db->real_escape_string($_POST["password"]);
  $confirm = $db->real_escape_string($_POST["confirm"]);

  if ($unsalted == $confirm) {
    if (!bad_password($unsalted)) {
    // encrypt password & fetch salt
    $string = uniqid();
    $password = $unsalted . $string; // add unique salt
    $password = hash('sha256', $password); // hash password
    add_to_db($username, $password, $string, $db);
    } else {
      echo "<div><p class=\"signuperror\">
        Password must consist of:
        <ul>
          <li>8 Characters</li>
          <li>At least one uppercase character</li>
          <li>At least one uppercase character</li>
          <li>At least one special character</li>
        </ul>
      </p></div>";
    }
  } else {
    echo "<p class=\"signuperror\">
      Passwords do not match
    </p>";
  }
}

function add_to_db($username, $password, $string, $db) {
  $query = "INSERT INTO User_tbl " . "
    (User_Name, User_Password, Salt, Logged_IN) " . "
    VALUES ('{$username}', '{$password}', '{$string}' , '0');";
    if ($result = $db->query($query) == TRUE) {
      echo "success";
    } else {
      echo "error on inserting";
    }
}

function unique_user() {

}

function bad_password($password) {
  return notEight ($password) && noUpper ($password) &&
  noLower ($password) && noSpecial ($password);
}

function notEight( $str ) {
  return strlen ( $str ) < 8;
}
function noUpper( $str ) {
  return ! preg_match ( " /[ A - Z ]/ " , $str );
}
function noLower( $str ) {
  return ! preg_match ( " /[ a - z ]/ " , $str );
}
function noSpecial( $str ) {
  $regex = " /[%^&*]/ " ; // Check for % ^ & *
  return ! preg_match ( $regex , $str );
}

function sql_check_name($db, $name) {
  $query = "SELECT * FROM `Ships_tbl` WHERE Boat_Name = '{$name}'";
  $result = $db->query($query);

  if ( $result -> num_rows > 0) {
    while ( $row = $result -> fetch_assoc ()) {
      $name = $row ['Boat_Name'];
    }
  } else {
    return 0;
  }

  header('Location: container.php?boat=' . $name);
}

function sql_fetch_data($db, $name) {
  $query = "SELECT * FROM `Ships_tbl` WHERE Boat_Name = '{$name}'";
  $result = $db->query($query);

  if ( $result -> num_rows > 0) {
    while ( $row = $result -> fetch_assoc ()) {
      $name = $row ['Boat_Name'];
      $year = $row ['Year_Built'];
      $capacity = $row ['Capacity'];
      $manufactor = $row ['Manufacturer'];
      $operator = $row ['Operator'];
      $img =  $row ['Image'];
    }

    $img = '<img src="img/'.$img.'" alt="AlQibla" class="shipimage" />';
    $name = '<h2 class="name">'.$name.'</h2>';
    $year = '<h3 class="year">'.$year.'</h3>';
    $capacity = '<p class="capacity">'.$capacity.'</p>';
    $manufactor = '<p class="manufactor">'.$manufactor.'</p>';
    $operator = '<p class="operator">'.$operator.'</p>';

    echo $img . $capacity . $year . $name . $manufactor. $operator;

  } else {
    header('Location: index.php');
  }
}

function preprocess_dropdown($db) {
  $query = "SELECT Manufacturer FROM `Ships_tbl` ORDER BY Manufacturer ASC";
  $result = $db->query($query);

  if ( $result -> num_rows > 0) {
    while ( $row = $result -> fetch_assoc ()) {
      echo '<option value="';
      echo $row ["Manufacturer"] . '" > ';
      echo $row ["Manufacturer"];
      echo '</ option>';
    }
  }
}

function fetch_results($db, $company) {
  $query = "SELECT Boat_Name, Capacity FROM `Ships_tbl` WHERE Manufacturer_ID = '{$company}'";
  $result = $db->query($query);
  if ( $result -> num_rows > 0) {
    print_table($result);
  } else {
    echo "<p class=\"signuperror\">
      No boats under that manufacturer currently
    </p>";}
}

function print_table($result) {
  while ( $row = $result -> fetch_assoc()) {
    $name = $row ['Boat_Name'];
    $capacity = $row ['Capacity'];
    echo '<tr><th>';
    echo $name . '</th>';
    echo '<th>'.$capacity.'</th>';
    echo '<th><a class="link" href="container.php?boat='.$name.'">link</a></th>';
    echo '</tr>';
  }
}

function add_new_boat($db, $name, $year, $capacity, $operator, $manufactorer, $file) {
  $year = intval($year);
  $capacity= intval($capacity);
  $query = "INSERT INTO Ships_tbl (`Boat_Name`, `Year_Built`, `Capacity`, `Manufacturer`, `Operator`, `Image` ) VALUES ('{$name}', '{$year}', '{$capacity}', '{$manufactorer}', '{$operator}', '{$file}');";
  $result = $db->query($query);
  echo "<p>Inserted boat: ".$name.". year built: ".$year.". capacity: ".$capacity.". manufacturer: ".$manufactorer.". operator: ".$operator.
  ". image url: ".$file."</p><br /><a class=\"button\" href=\"index.php\">Head Home</a>";
}

function edit_name($db, $name, $boat) {
  $query = "UPDATE `ships_tbl` SET `Boat_Name`='{$name}' WHERE Ship_ID = '{$boat}';";
  $result = $db->query($query);
  header("Location: container.php?boat=".$name);
}
function edit_year($db, $year, $boat) {
  $query = "UPDATE `ships_tbl` SET `Year_Built`='{$year}' WHERE Ship_ID = '{$boat}';";
  $result = $db->query($query);
}
function edit_capacity($db, $capacity, $boat) {
  $query = "UPDATE `ships_tbl` SET `Capacity`='{$capacity}' WHERE Ship_ID = '{$boat}';";
  $result = $db->query($query);
}
function edit_manufactorer($db, $manufactorer, $boat) {
  $query = "UPDATE `ships_tbl` SET `Manufacturer`='{$manufactorer}' WHERE Ship_ID = '{$boat}';";
  $result = $db->query($query);
}
function edit_operator($db, $operator, $boat) {
  $query = "UPDATE `ships_tbl` SET `Operator`='{$operator}' WHERE Ship_ID = '{$boat}';";
  $result = $db->query($query);
}
function edit_image($db, $file, $boat) {
  $query = "UPDATE `ships_tbl` SET `Image`='{$file}' WHERE Ship_ID = '{$boat}';";
  $result = $db->query($query);
}

function fetch_ID($db, $boat) {
  $query = "SELECT Ship_ID FROM `ships_tbl` WHERE Boat_Name = '{$boat}'";
  $result = $db->query($query);
  if ( $result -> num_rows > 0) {
    while ( $row = $result -> fetch_assoc ()) {
      return $row['Ship_ID'];
    }
  }
}

?>
