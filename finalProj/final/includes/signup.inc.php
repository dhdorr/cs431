<?php
session_start();
  if (isset($_POST['signup_submit'])) {
    require 'dbh.inc.php';

    $u_name = $_POST['username'];
    $u_nickname = $_POST['nickname'];
    $u_pwd = $_POST['pwd'];
    $errcheck = 0;
    $errmessage = "";
    $filename = basename($_FILES["uploadfile"]["name"]);

    //check duplicates account name
    $dupesql = "SELECT u_name FROM users WHERE u_name ='$u_name' ";
    $duperaw = mysqli_query($conn, $dupesql);
    if (mysqli_num_rows($duperaw) > 0) {
      $errmessage = "user name has already exists";
      $_SESSION['errmessage'] = 'user name has already exists';
      $errcheck = 1;
    }
    //password mathes
    else if ($_POST['pwd'] != $_POST['repwd']) {
      $errmessage = "password not match";
      $_SESSION['errmessage'] = 'password not match';
      $errcheck = 1;
    }

        #Form handling & checks if image is ok to upload
        $dir = "../images/";
        $file = $dir . basename($_FILES["uploadfile"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        #check if uploadfile is jepg/png
        $info = getimagesize($_FILES['uploadfile']['tmp_name']);

        if ($info === FALSE) {
          $uploadOk = 0;
        }
        else if (($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
          $uploadOk = 0;
          echo "File type not support</br>";
        }

        #checks if the upload is ok
        if ($uploadOk == 0) {
          echo "File failed to upload</br>";
        } else {
          if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $file)) {
            echo "upload success</br>";
          } else {
            $uploadOk = 0;
            echo "File failed to upload</br>";
          }
        }

    if ($errcheck == 0) {

    $query = "INSERT INTO users (u_name, u_nickname, u_pwd, u_avatar ) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      header("Location: ../home.php?error=sqlfailed");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "ssss", $u_name, $u_nickname, $u_pwd, $filename);
      mysqli_stmt_execute($stmt);

      header("Location: ../login.php?signup=success");
      exit();
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }

  else{
    header("Location: ../signup.php?errormsg=$errmessage " );
  }
}
