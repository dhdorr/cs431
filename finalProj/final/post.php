<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="widht=device-width, initial-scale=1">
    <title>My Sample Post</title>
    <!-- Insert Navbar -->
    <?php require "header.php"; ?>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <!-- Create Space on page -->
        </br>
      </div>
      <div class="row justify-content-center">
        <?php
        //get data passed from URL
        if (isset($_GET['pid'])) {
          $pid = $_GET['pid'];
          $fname = $_GET['fname'];
          $fid = $_GET['fid'];
        ?>
        <?php
            //access database to get posts
            require 'includes/dbh.inc.php';

            $query = "SELECT * FROM posts WHERE p_id=$pid";
            $result = $conn->query($query);

            if($result->num_rows > 0){
              //get data for each post
              while($row = mysqli_fetch_assoc($result)){
                //display posts from database
                echo "<div class='card text-white bg-dark mb-3 w-75'>
                          <h3 class='card-header'>".$row['p_title']."</h3>
                            <div class='card-body'>
                              <h6 class='card-subtitle'>".$row['p_subject']."</h6>
                              <p class='card-body'>".$row['p_body']."</p>
                            </div>
                          </div>";
              }
            }
            else {
              echo "<h6>Nothing here yet</h6>";
            }
            $conn->close();
          }
        ?>
        <?php
        echo "<a type='button' class='btn btn-secondary btn-sm btn-block w-75' href='forum.php?fname=".$fname."&fid=".$fid."' id='a'> GO BACK </a>"
        ?>
      </div>
    </div>
  </body>
</html>
