<?php

function sign_in($db) {
  $username = $db->real_escape_string($_POST["username"]);
  $unsalted = $db->real_escape_string($_POST["password"]);

  // encrypt password & fetch salt
  $string = fetch_salt($db, $username);
  $password = $unsalted . $string; // add unique salt
  $password = hash('sha256', $password); // hash password
  if (!sql_sign_in($username, $password, $db)) {
    echo "<p class=\"errorlogin\">Could not log in, username or password incorrect</p>";
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

function sql_sign_in($username, $password, $db) {
  $query = "UPDATE User_tbl SET Logged_IN = '1' WHERE User_Name = '{$username}' AND User_Password = '{$password}'";
  $result = $db->query($query);
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

?>
