<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="widht=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="home.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <title>My Home</title>

  <!-- Insert Navbar -->
  <?php require "header.php";
  $favicon = "<svg class='bi bi-star' width='2em' height='2em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 00-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 00-.163-.505L1.71 6.745l4.052-.576a.525.525 0 00.393-.288l1.847-3.658 1.846 3.658a.525.525 0 00.393.288l4.052.575-2.906 2.77a.564.564 0 00-.163.506l.694 3.957-3.686-1.894a.503.503 0 00-.461 0z' clip-rule='evenodd'/></path></svg>";
  $favicon2 = "<svg class='bi bi-star-fill' width='2em' height='2em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z'/></svg>";
  ?>

</head>

<body>
  <div class="container-fluid">
    <div class="row justify-content-center mt-3 mb-5">
      <h2>Welcome to the Forums!</h2>
    </div>
    <div class="row justify-content-center">
      <?php
      $isLoggedIn = false;
      if (isset($_SESSION['uId'])) {
        $uid = $_SESSION['uId'];
      }
      //If a session exists, change layout of homepage
      if (isset($_SESSION['uNickname'])) {
        $name = $_SESSION['uNickname'];
        $isLoggedIn = true;


      } else {
        //display default layout
        echo "<div class='row justify-content-center'>
                    <h2>Log In to View Forums</h2>
                  </div>";
      }
      ?>
    </div>
    <div class="row justify-content-center">
      <?php

      //If a session exists, change layout of homepage
      if ($isLoggedIn) {
        //access database to get forums
        require 'includes/dbh.inc.php';

        $query = "SELECT * FROM forums";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
          //get data for each row
          while ($row = mysqli_fetch_assoc($result)) {
            $fid = $row['f_id'];
            //display forums from database
            $query2 = "SELECT * FROM favorites where u_id=$uid and f_id=$fid";
            $result2 = $conn->query($query2);
            if ($result2->num_rows > 0) {
              echo "

                  <div class='card text-white bg-dark mb-3 w-75' >
                                <div class='card-header'> Add to favorite <button id='favorite-button" . $fid . "' class='favorite-button' value='$fid' onclick='addFavorite($fid)'>$favicon2</button> </div>
                                <a class='card-body text-light'  href='forum.php?fname=" . $row['f_name'] . "&fid=" . $row['f_id'] . "'>
                                  <h5 class='card-title text-light' >" . $row['f_name'] . "</h5>

                                  <p class='card-text text-light'>" . $row['f_description'] . "</p>
                                  </a>
                                </div>
                              ";
            } else {



              echo "

              <div class='card text-white bg-dark mb-3 w-75' >
                            <div class='card-header'> Add to favorite <button id='favorite-button" . $fid . "' class='favorite-button' value='$fid' onclick='addFavorite($fid)'>$favicon</button> </div>
                            <a class='card-body text-light'  href='forum.php?fname=" . $row['f_name'] . "&fid=" . $row['f_id'] . "'>
                              <h5 class='card-title text-light' >" . $row['f_name'] . "</h5>

                              <p class='card-text text-light'>" . $row['f_description'] . "</p>
                              </a>
                            </div>
                          ";
            }
          }
        } else {
          echo "failed";
        }
        $conn->close();
      }

      ?>


    </div>
  </div>
  <script>
    $(document).ready(function() {
      $("button").click(function() {
        var fid = $(this).val();
        console.log(fid);
        $.post("favorite.php", {
            fid: fid

          },
);
      });
    });
  </script>
  <script>
    function addFavorite(fid) {

      var favicon = '<svg class="bi bi-star" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 00-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 00-.163-.505L1.71 6.745l4.052-.576a.525.525 0 00.393-.288l1.847-3.658 1.846 3.658a.525.525 0 00.393.288l4.052.575-2.906 2.77a.564.564 0 00-.163.506l.694 3.957-3.686-1.894a.503.503 0 00-.461 0z" clip-rule="evenodd"></path></svg>';
      var favicon2 = '<svg class="bi bi-star-fill" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>';
      var x = document.getElementById("favorite-button" + fid);

      if (x.innerHTML == favicon) {
        x.innerHTML = favicon2;

      } else {
        x.innerHTML = favicon;

      }
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
