<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="widht=device-width, initial-scale=1">
    <title>My Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
    <!-- Insert Navbar -->
    <?php require "header.php";

    ?>
  </head>

<body class="text-center">
  <form class="form-signin" action="includes/signup.inc.php" method="post">
    
    <h1 class="h3 mb-3 font-weight-normal">Creat an account</h1>
    <h1 class="h6 mb-3 font-weight-normal"> <?= $_GET['errormsg'] ?></h1>
    

    <input type="acount" name="username" class="form-control" placeholder="Account name" required="" autofocus="">

    <input type="acount" name="nickname" class="form-control" placeholder="nick name" required="">

    <input type="password" name="pwd" class="form-control" placeholder="Password" required="">

    <input type="password" name="repwd" class="form-control" placeholder="Confirm Password" required="">


    <button class="btn btn-lg btn-primary btn-block" type="submit" name="signup_submit">Creat Account</button>
    <p class="mt-5 mb-3 text-muted">© 2020</p>
  </form>
  <?php

  ?>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
