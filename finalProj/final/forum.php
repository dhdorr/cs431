<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="widht=device-width, initial-scale=1">
    <title>My Sample Forum</title>
    <!-- Insert Navbar -->
    <?php require "header.php"; ?>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <?php
          if (isset($_GET['fname'])) {
            $fname = $_GET['fname'];
          }
        ?>
        <h2>We are in <?php echo $fname; ?></h2>
      </div>
    </div>
  </body>
</html>
