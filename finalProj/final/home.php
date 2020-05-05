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
        <h2>We are home.</h2>
      </div>
      <div class="row justify-content-center">
        <?php
          //If a session exists, change layout of homepage
          if (isset($_SESSION['uName'])) {
            $name = $_SESSION['uName'];

            echo "<div class='row justify-content-center'>
                    <h2>".$name."'s Favorite Forums</h2>
                  </div>";
            //access database to get forums
            require 'includes/dbh.inc.php';

            $query = "SELECT * FROM forums";
            $result = $conn->query($query);

            if($result->num_rows > 0){
              //get data for each row
              while($row = mysqli_fetch_assoc($result)){
                //display forums from database
                echo "<a class='card text-white bg-dark mb-3 w-75' href='forum.php?fname=".$row['f_name']."' id='a'>
                            <div class='card-body'>
                              <h5 class='card-title'>".$row['f_name']."</h5>
                              <p class='card-text'>".$row['f_description']."</p>
                            </div>
                          </a>";
              }
            }
            else {
              echo "failed";
            }
            $conn->close();
          }
          else {
            //display default layout
            echo "<div class='row justify-content-center'>
                    <h2>Log In to View Forums</h2>
                  </div>";
          }
        ?>
      </div>
    </div>
  </body>
</html>
