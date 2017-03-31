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
        require_once('../resources/requirephp/dbc.php'); // connect to db
        $username = login_logout_button($db, $username);
        if ($username != null) {
          $_SESSION['username'] = $username;
          header("Location: index.php");
        }
      ?>
    </div>

    <!-- Div that center aligns the entire webpage -->
    <div class="centeralign">
      <div class="center">
        <img src="../resources/ship.png" alt="homepageship"/>
        <h2 class="header"> <b>Find<i>a</i>Ship</b> <br /> The best way to search ships since the spyglass.</h2>
        <h6 class="header">In the interest of selling your information on - you must be registered and logged in to use this site properly.</h6>
      </div>
      <section class="search">
        <div class="center">
          <div class="spacer">
            <form class="form" name="searchname" method="post" >
              <input class="searchbar" name="namesearch" type="text" placeholder="Search ship by name"/>
            </form>
          </div>
          <?php
          if (isset($_SESSION['username'])) {
            search_by_name($db);
          }
          ?>
          <div class="spacer">
            <form class="rangeform" method="post" onchange="showRange()">
              <input class="capacity" type="number" id="lowerrange" name="lowerrange" placeholder="Lower Value"/>
              <input class="capacity" type="number" id="upperrange" name="upperrange" placeholder="Upper Value"/>
            </form>
          </div>
          <?php
          if (isset($_SESSION['username'])) {
            if(isset($_POST['submit'])) { ?>
              <div class="center" id="rangetable">
                <!-- ajax query displays table ehre -->
              </div> <?php
            }
          }
          ?>
          <div class="spacer">
            <form name="companyform" method="post">
              <select name="company" onchange="showTable(this.value)">
                <option value="">Select a company:</option>
                <?php
                preprocess_dropdown($db);
                $db->close();
                ?>
              </select>
            </form>
          </div>
        </div>
      </section>

      <section>
        <?php if (isset($_SESSION['username'])) { ?>
        <div class="center" id="displaytable">
          <!-- ajax query displays table ehre -->
        </div> <?php
      } ?>
      </section>

    </div>
<!-- Footer -->
  </body>
</html>
