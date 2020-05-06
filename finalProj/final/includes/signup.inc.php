<?php
session_start();
  if (isset($_POST['signup_submit'])) {
    require 'dbh.inc.php';

    $u_name = $_POST['username'];
    $u_nickname = $_POST['nickname'];
    $u_pwd = $_POST['pwd'];
    $errcheck = 0;
    $errmessage = "123";

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


    if ($errcheck == 0) {
    $query = "INSERT INTO users (u_name, u_nickname, u_pwd) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      header("Location: ../home.php?error=sqlfailed");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "sss", $u_name, $u_nickname, $u_pwd);
      mysqli_stmt_execute($stmt);    
      $_SESSION['uName'] = $u_name;
      header("Location: ../home.php?signup=success");
      exit();
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }
  
  else{
    header("Location: ../signup.php?errormsg=$errmessage " ); 
  }
}
?>
