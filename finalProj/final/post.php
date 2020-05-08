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
                $sampleId = $row['u_id'];
                $query2 = "SELECT u_name FROM users WHERE u_id=$sampleId";
                $result2 = $conn->query($query2);
                if ($result2->num_rows > 0) {
                  while ($row2 = mysqli_fetch_assoc($result2)) {
                    $sampleName = $row2['u_name'];
                  }
                }
                //display posts from database
                echo "<div class='card text-white bg-dark mb-3 w-75'>
                          <h3 class='card-header'>".$row['p_title']."</h3>
                            <div class='card-body'>
                              <h6 class='card-subtitle'>".$row['p_subject']."</h6>
                              <p class='card-body'>".$row['p_body']."</p>
                            </div>
                            <div class='card-footer text-muted'>Posted By: ".$sampleName."</div>
                          </div>";
              }
            }
            else {
              echo "<h6>Nothing here yet</h6>";
            }
            //$conn->close();
          }
        ?>
      </div>

      <div class="row justify-content-center">

          <form class="mb-5 w-75" action="includes/makecomment.inc.php?pid=<?php echo $pid; ?>" method="post">
              <div class="form-group">
                <label for="commentBody">Comment</label>
                <textarea class="form-control" name="commentBody" rows="3"></textarea>
              </div>
            <button type="submit" name="post_comment" class="btn btn-primary">Submit</button>
          </form>

      </div>

      <div class="row justify-content-center">

        <?php
        $query3 = "SELECT * FROM comments WHERE p_id=$pid";
        $result3 = $conn->query($query3);

        if($result3->num_rows > 0){
          //get data for each post
          while($row3 = mysqli_fetch_assoc($result3)){
            $sampleId2 = $row3['u_id'];
            $query4 = "SELECT u_name, u_avatar FROM users WHERE u_id=$sampleId2";
            $result4 = $conn->query($query4);
            if ($result4->num_rows > 0) {
              while ($row4 = mysqli_fetch_assoc($result4)) {
                $sampleName2 = $row4['u_name'];
                $cPic = $row4['u_avatar'];
              }
            }
            //display posts from database
            /*echo "<div class='card text-white bg-dark mb-3 w-75'>
                    <h3 class='card-header'>".$sampleName2."</h3>
                        <div class='card-body'>
                          <p class='card-body'>".$row3['c_body']."</p>
                        </div>
                      </div>";*/
            echo "<div class='media w-75 mb-4'>
                    <img src=images/".$cPic." class='align-self-start mr-3 rounded' alt='logo' width=50 height=50>
                    <div class='media-body'>
                      <h6 class='mt-0'>".$sampleName2."</h6>
                      ".$row3['c_body']."
                    </div>
                  </div>";
          }
        }
        else {
          echo "<h6>Nothing here yet</h6>";
        }
        $conn->close();
        ?>
      </div>

      <div class="row mb-3">
        </br>
      </div>

      <div class="row justify-content-center">
        <?php
          echo "<a type='button' class='btn btn-secondary btn-sm btn-block w-75' href='forum.php?fname=".$fname."&fid=".$fid."' id='a'> GO BACK </a>";
        ?>
      </div>
    </div>
  </body>
</html>
