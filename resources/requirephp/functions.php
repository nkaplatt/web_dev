<!-- function to display either login or logout depending of user state -->
<?php

function login_logout_button($db, $user_name) {
  if(!isset($_SESSION['username'])) { ?>
    <form name="loginform" class="loginform" method="post">
      <input class="loginfield" type="text" name="username" placeholder="Enter username" required/>
      <input class="loginfield" type="password" name="password" placeholder="Enter password" required/>
      <input class="submit" type="submit" name="loginbutton" value="login"/>
      <a href="signup.php" class="button">register</a>
    </form> <br />
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      if(isset($_POST["username"]) && isset($_POST["password"])) {
        if (sign_in($db) == 1) {
          return $_POST["username"];
        }
      }
    }
  } else { ?>
      <a class="login" href="logout.php">logout</a>
    <?php
  }
}

function search_by_name($db) {
  if(isset($_POST["namesearch"])) {
    $name = $_POST["namesearch"];
    if (sql_check_name($db, $name) == 0) {
      echo "<p class=\"errorlogin\">Boat not found, please try again.</p>";
    }
  }
}

function make_table($db) {
  if(isset($_POST["company"])) {
    $company = $_POST["company"];
    fetch_results($db, $company);
  }
}

function edit_boat() {

}

function delete_boat() {

}

?>
