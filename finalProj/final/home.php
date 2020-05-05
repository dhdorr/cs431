<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="widht=device-width, initial-scale=1">
    <title>My Home</title>
    <!-- Insert Navbar -->
    <?php require "header.php"; ?>
  </head>
  <body>
    <div class="container-fluid">
      <h2>We are home.</h2>
      <?php
        if (isset($_SESSION['uName'])) {
          echo $_SESSION['uName'];
          echo '<div><a class="btn btn-outline-primary text-primary" href="includes/logout.inc.php">LOG OUT</a></div>';
        }
      ?>
    </div>
  </body>
</html>
