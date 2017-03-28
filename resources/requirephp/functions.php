<!-- function to display either login or logout depending of user state -->
<?php

function login_logout_button($db, $user_name) {
  if(!is_user_logged_in($db, $user_name)) { ?>
    <form onsubmit="window.location.reload()" class="loginform" method="post">
      <input class="loginfield" type="text" name="username" placeholder="Enter username" required/>
      <input class="loginfield" type="password" name="password" placeholder="Enter password" required/>
      <input class="submit" type="submit" name="login" value="login"/>
      <a href="signup.php" class="button">register</a>
    </form>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      if(isset($_POST["username"]) && isset($_POST["password"])) {
        sign_in($db); // sign into site
      }
    }
  } else { ?>
    <form>
        <input class="login" type="submit" value="logout">
    </form>
    <?php
    // log out query
  }
}

?>
