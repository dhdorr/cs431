<?php
  if (isset($_POST['signup_submit'])) {
    require 'dbh.inc.php';

    $u_name = $_POST['username'];
    $u_nickname = $_POST['nickname'];
    $u_pwd = $_POST['pwd'];

    $query = "INSERT INTO users (u_name, u_nickname, u_pwd) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      header("Location: ../home.php?error=sqlfailed");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "sss", $u_name, $u_nickname, $u_pwd);
      mysqli_stmt_execute($stmt);

      session_start();
      $_SESSION['uName'] = $u_name;

      header("Location: ../home.php?signup=success");
      exit();
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }
?>
