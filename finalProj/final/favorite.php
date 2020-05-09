<?php
session_start();
if (isset($_SESSION['uId'])) {
    $uid = $_SESSION['uId'];
  }
require 'includes/dbh.inc.php';

try { 

    if (isset($_POST['fid'])){
        $fid=$_POST['fid'];
        $query2 = "SELECT * FROM favorites where u_id=$uid and f_id=$fid";
        $result2 = $conn->query($query2);
        if($result2->num_rows > 0){
            $query3 = "DELETE FROM favorites  where u_id=$uid and f_id=$fid";
            $result3 = $conn->query($query3);

        }
    
        else{

        $query = "INSERT INTO favorites (f_id, u_id) VALUES (?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $query)) {

          exit();
        }
        else {
          mysqli_stmt_bind_param($stmt, "ii", $fid, $uid);
          mysqli_stmt_execute($stmt);
    

          exit();
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        
        }
    }

    


} catch(Exception $e) {

}
?>