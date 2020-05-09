<?php
  $errormsg="";
  if (isset($_POST['login_submit'])) {
    require 'dbh.inc.php';

    $u_name = $_POST['username'];
    $u_pwd = $_POST['pwd'];

    $query = "SELECT * FROM users WHERE u_name=? AND u_pwd=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      header("Location: ../home.php?error=sqlfailed");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "ss", $u_name, $u_pwd);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        session_start();
        $_SESSION['uName'] = $row['u_name'];
        $_SESSION['uNickname'] = $row['u_nickname'];
        $_SESSION['uId'] = $row['u_id'];
        $_SESSION['uAvatar'] = $row['u_avatar'];
        header("Location: ../home.php?login=success");
        exit();
      }
      else {
        $errormsg='Wrong username or password';
        header("Location: ../login.php?errormsg=$errormsg");
        exit();
      }
    }
  }
?>
