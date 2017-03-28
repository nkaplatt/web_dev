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
        require_once('../resources/requirephp/dbc.php'); // connect to db
        login_logout_button($db, $user_name);
      ?>
    </div>

    <!-- Div that center aligns the entire webpage -->
    <div class="centeralign">
      <div class="center">
        <img src="../resources/ship.png" alt="homepageship"/>
        <h2 class="header"> <b>Find<i>a</i>Ship</b> <br /> The best way to search ships since the spyglass.</h2>
      </div>
      <section class="search">
        <div class="center">
          <form class="form">
            <input class="searchbar" type="text" name="namesearch" placeholder="Search ship by name"/>
          </form>

          <form class="rangeform">
            <input class="" type="text" name="namesearch" /> <br>
            <input class="" type="text" name="namesearch" />
          </form>
        </div>
      </section>

      <section>
        <div class="center">
          <table class="summary">
            <tr>
              <th>Name</th>
              <th>Manufacturer</th>
              <th>Capacity</th>
            </tr>
          </table>
        </div>
      </section>

    </div>
<!-- Footer -->
  </body>
</html>
