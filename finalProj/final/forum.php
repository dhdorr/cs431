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
    <?php
      //Page Title
      $testme = "<div class='row justify-content-center'><h6>Nothing here yet</h6></div>";
      $hasFailed = false;
      //get data passed from URL
      if (isset($_GET['fname'])) {
        $fname = $_GET['fname'];
        $fid = $_GET['fid'];
      }
    ?>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <h2>We are in <?php echo $fname; ?></h2>
      </div>
      <div class="row">
        <div class="col-9">
          <?php
            //access database to get posts
            require 'includes/dbh.inc.php';

            $query = "SELECT * FROM posts WHERE f_id=$fid";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
              //get data for each post
              while ($row = mysqli_fetch_assoc($result)) {
                $sampleId = $row['u_id'];
                $query2 = "SELECT u_name FROM users WHERE u_id=$sampleId";
                $result2 = $conn->query($query2);
                if ($result2->num_rows > 0) {
                  while ($row2 = mysqli_fetch_assoc($result2)) {
                    $sampleName = $row2['u_name'];
                  }
                }
                //display posts from database
                echo "<a class='card text-white bg-dark mb-3 w-100' href='post.php?pid=".$row['p_id']."&fname=".$fname."&fid=".$fid."'>
                        <div class='card-body'>
                          <h5 class='card-title'>".$row['p_title']."</h5>
                          <p class='card-text'>".$row['p_subject']."</p>
                        </div>
                        <div class='card-footer text-muted'>Posted By: ".$sampleName."</div>
                      </a>";
              }
            }
            else {
              //do something
              $hasFailed = true;
              //echo $testme;
            }
            $conn->close();
          ?>
          <?php
          echo "<a type='button' class='btn btn-secondary btn-sm btn-block w-100' href='home.php'> GO BACK </a>"
          ?>
          <div class="row">
            </br>
          </div>
        </div>
        <div class="col">
          <div class="row justify-content-center">
            <?php
              echo "<a type='button' class='btn btn-primary' href='makepost.php?fid=".$fid."'>Create Post</a>";
            ?>
          </div>
        </div>
      </div>
      <?php if ($hasFailed) {echo $testme;} ?>
    </div>
  </body>
</html>
