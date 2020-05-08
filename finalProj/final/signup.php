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

<body>
  <div class="row justify-content-center">
    <div class="col col-3">
      <form class="form-signin" action="includes/signup.inc.php" method="post" enctype="multipart/form-data">

        <h1 class="h3 mb-3 font-weight-normal">Creat an account</h1>
        <?php if(isset($_GET['errormsg'])) {
          echo "<h1 class='h6 mb-3 font-weight-normal'>".$_GET['errormsg']."</h1>";
        } ?>

        <label for="uname" class="row justify-content-left px-md-3">Username</label>
        <input type="acount" name="username" class="form-control" placeholder="Account name" required="" autofocus="">

        <label for="unickname" class="row justify-content-left px-md-3">Nickname</label>
        <input type="acount" name="nickname" class="form-control" placeholder="nickname" required="">

        <label for="password" class="row justify-content-left px-md-3">Password</label>
        <input type="password" name="pwd" class="form-control" placeholder="Password" required="">

        <label for="repwd" class="row justify-content-left px-md-3">Re-enter Password</label>
        <input type="password" name="repwd" class="form-control" placeholder="Confirm Password" required="">

        <div class="row">
        </br>
        </div>

        <div class="row justify-content-center">
          <img id="blah" src="#" alt="your image" width=100 height=100>
        </div>

        <div class="row">
        </br>
        </div>

        <div class="custom-file">

          <input type="file" class="custom-file-input" name="uploadfile" onchange="readURL(this);">
          <label class="custom-file-label" for="customFile">Upload an avatar</label>

        </div>

        <div class="row">
        </br>
        </div>

        <button class="btn btn-primary btn-block" type="submit" name="signup_submit">Creat Account</button>
        <p class="mt-5 mb-3 text-muted">© 2020</p>
      </form>
    </div>

  </div>

  <script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
