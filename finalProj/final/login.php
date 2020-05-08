<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="widht=device-width, initial-scale=1">
    <title>My Log In</title>
    <!-- Insert Navbar -->
    <?php require "header.php"; ?>
  </head>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


  <!-- Custom styles for this template -->
  <link href="style.css" rel="stylesheet">


<body class="text-center">
  <div class="row justify-content-center">
    <div class="col col-3">
      <form class="form-signin" action="includes/login.inc.php" method="post">

        <h2 class="h3 mt-3 mb-5 font-weight-normal">Please sign in</h2>
        <?php if(isset($_GET['errormsg'])) {
          echo "<h1 class='h6 mb-3 font-weight-normal'>".$_GET['errormsg']."</h1>";
        } ?>

        <input type="acount" id="useraccount" name="username" class="form-control" placeholder="Account name" required="" autofocus="">

        <input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Password" required="">

        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login_submit">Sign in</button>

      </form>
    </div>
  </div>

  <div class="d-flex justify-content-center links">
    Don't have an account?<a href="signup.php">Sign Up</a>
  </div>
  <p class="mt-5 mb-3 text-muted">© 2020</p>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
