<?php

session_start();
if(empty($_SESSION['tutor_id'])){
  header("Location:scripts/error404");
  exit();
} else{
  require_once 'scripts/database.php';

  $tutor_id = $_SESSION['tutor_id'];

  if(!empty($_POST['username'])){
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);

    // Check if username is taken here //
    $username = mysqli_real_escape_string($con, $username);

    $sql = "UPDATE tblTutors SET username = ? WHERE tutor_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "error preparing username update";
    } else{
      mysqli_stmt_bind_param($stmt, "si", $username, $tutor_id);
      mysqli_stmt_execute($stmt);
    }
  }





header("Location: tutor");
exit();
}




?>
