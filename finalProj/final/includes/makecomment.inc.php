<?php
  if (isset($_POST['post_comment'])) {
    require 'dbh.inc.php';
    session_start();

    $pid = $_GET['pid'];
    $c_body = $_POST['commentBody'];
    $uid = $_SESSION['uId'];

    $query = "INSERT INTO comments (u_id, p_id, c_date, c_body) VALUES (?, ?, now(), ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      header("Location: ../home.php?error=sqlfailed");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "iis", $uid, $pid, $c_body);
      mysqli_stmt_execute($stmt);
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else {
    echo "nope";
  }

/*

*/
?>
