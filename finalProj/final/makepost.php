<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="widht=device-width, initial-scale=1">
    <title>My Sign Up</title>
    <!-- Insert Navbar -->
    <?php require "header.php"; ?>
    <?php
      $fid = $_GET['fid'];
      $_SESSION['fId'] = $fid;
    ?>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <h2>We are making posts.</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-8">

        <form class="form-makepost" action="includes/makepost.inc.php" method="post">
          <div class="form-group">
            <label for="makepostTitle">Title</label>
            </br>
            <input type="text" class = "form-control form-control-lg w-100" placeholder="Title" name="makepostTitle">
          </div>
          <div class="form-group">
            <label for="makepostSubject">Subject</label>
            </br>
            <input type="text" class="form-control form-control-lg w-100" placeholder="Subject" name="makepostSubject">
          </div>
          <div class="form-group">
            <label for="makepostBody">Body</label>
            </br>
            <textarea class="form-control form-control-lg w-100" name="makepostBody" rows="8" placeholder="Body"></textarea>
          </div>
          <button type="submit" name="makepost_submit" class="btn btn-dark">SUBMIT</button>
        </form>

        </div>
      </div>
    </div>
  </body>
</html>
