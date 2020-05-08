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
      <div class="row justify-content-center">
        <h2>Account Page.</h2>
      </div>

      <div class="row">
      </br>
      </div>

      <div class="row justify-content-center">

          <img src="images/<?php if (!isset($_SESSION['uAvatar']) || strlen($_SESSION['uAvatar']) < 3) {
                                    echo "myBishop.png";
                                  }
                                  else {
                                    echo $_SESSION['uAvatar'];
                                  }
                            ?>" class="img-thumbnail" alt="logo" >

      </div>

      <div class="row">
      </br>
      </div>

      <div class="row justify-content-center">
        <div class="col-1">
          <?php
            echo "<p>Username: ".$_SESSION['uName']."</br>"."Nickname: ".$_SESSION['uNickname']."</br></p>";
          ?>
        </div>
      </div>

      <div class="row">
      </br>
      </div>



      <div class="row">
      </br>
      </div>

      <div class="row justify-content-center">
        <form class="form-change-avatar" action="includes/avatar.inc.php" method="post" enctype="multipart/form-data">
          <div class="custom-file">

            <input type="file" class="custom-file-input" name="uploadfile" onchange="readURL(this);">
            <label class="custom-file-label" for="customFile">Change Avatar?</label>

            <div class="row">
            </br>
            </div>

            <button type='submit' name='avatarSubmit' class='btn btn-primary btn-sm'> SUBMIT </button>

          </div>
        </form>
      </div>
    </div>
    <script>
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            //$('#blah').attr('src', e.target.result);
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
