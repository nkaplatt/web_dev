<?php
  require_once('../resources/requirephp/header.php');
?>
<!-- Header -->
<title>Ship Finder</title>
  </head>
  <body class="body">
    <!-- Nav bar for login -->
    <div class="navlogin">
      <a class="logo" href="index.php">FindUrContainer.co.uk</a>
      <?php
        $user_name = "nick";
        // include query for submit to db
      ?>
    </div>
    <div class="centeralign">
      <section class="signup">
        <div class="center">
          <form class="signupform" method="post">
            <input class="signupfield" type="text" name="username" placeholder="Enter username" required/> <br>
            <input class="signupfield" type="password" name="password" placeholder="Enter password" required/> <br>
            <input class="signupfield" type="password" name="confirm" placeholder="Confirm password" required/> <br>
            <input class="submit" type="submit" name="login" value="register"/>
          </form>
          <?php
            require_once('../resources/requirephp/dbc.php'); // connect to db
            if($_SERVER["REQUEST_METHOD"] == "POST") {
              if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {
                sign_up($db);
              }
            }
          ?>
        </div>
      </section>
  </div>

  </body>
</html>
