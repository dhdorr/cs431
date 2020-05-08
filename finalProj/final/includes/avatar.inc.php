<?php
  if (isset($_POST['avatarSubmit'])) {
    require 'dbh.inc.php';
    session_start();
    $filename = basename($_FILES["uploadfile"]["name"]);
    $user = $_SESSION['uId'];

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

    $query = "UPDATE users SET u_avatar=? WHERE u_id=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      header("Location: ../account.php?error=sqlfailed");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "si", $filename, $user);
      mysqli_stmt_execute($stmt);
      $_SESSION['uAvatar'] = $filename;
      header("Location: ../account.php?change=success");
      exit();
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }
?>
