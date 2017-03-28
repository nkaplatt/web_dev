<?php
  error_reporting(E_ALL);
  require_once('../resources/requirephp/header.php');
  require_once('../resources/requirephp/dbc.php');
?>

<!-- Header -->
<title>Ship Finder</title>
  </head>
  <body class="body">
    <!-- Nav bar for login -->
    <div class="navlogin">
      <a class="logo" href="index.php">FindUrContainer.co.uk</a>
      <?php login_logout_button("hey"); ?>
    </div>

    <section class="search">
      <p class="center">
        Is this now centered
      </p>
      <div class="center">
        <form class="form">
          <input class="username" type="text" name="username" placeholder="Enter username"/> <br />
          <input class="password" type="text" name="password" placeholder="Enter password"/> <br />
          <input class="password" type="text" name="confirmp" placeholder="Confirm password"/> <br />
        </form>
      </div>
    </section>

  </body>
</html>
