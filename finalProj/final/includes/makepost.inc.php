<?php
  if (isset($_POST['makepost_submit'])) {
    require 'dbh.inc.php';

    $p_title = $_POST['makepostTitle'];
    $p_subject = $_POST['makepostSubject'];
    $p_body = $_POST['makepostBody'];
    session_start();
    $fid = $_SESSION['fId'];
    $uid = $_SESSION['uId'];


    $query = "INSERT INTO posts (p_title, p_subject, p_body, f_id, u_id, p_time) VALUES (?, ?, ?, ?, ?, now())";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      header("Location: ../home.php?error=sqlfailed");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "sssii", $p_title, $p_subject, $p_body, $fid, $uid);
      mysqli_stmt_execute($stmt);
      $message=mysqli_error($conn);
      //echo $fid.$uid.$p_title;
      //header('Location: ' . $_SERVER['HTTP_REFERER']);

      $query2 = "SELECT f_name FROM forums WHERE f_id=$fid";
      $result = $conn->query($query2);
      $row = mysqli_fetch_assoc($result);
      header("Location: ../forum.php?fname=" . $row['f_name'] . "&fid=" . $fid);
      exit();
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }
?>
