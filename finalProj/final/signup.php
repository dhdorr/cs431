<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="widht=device-width, initial-scale=1">
    <title>My Sign Up</title>
    <!-- Insert Navbar -->
    <?php require "header.php"; ?>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <h2>We are signing up.</h2>
      </div>
      <div class="row justify-content-center">        
        <form class="form-signup" action="includes/signup.inc.php" method="post">
          <input type="text" name="username" placeholder="Username">
          <input type="text" name="nickname" placeholder="Nickname">
          <input type="text" name="pwd" placeholder="Password">
          <button type="submit" name="signup_submit" class="btn btn-dark">SIGN UP</button>
        </form>
      </div>
    </div>
  </body>
</html>
