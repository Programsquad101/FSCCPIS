<?php

require_once 'scripts/database.php';
require_once 'scripts/app_config.php';

session_start();
$student_id = $_SESSION['student_id'];

$sql = "SELECT username FROM tblStudent WHERE student_id = ?;";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "ERROR PREPARE";
} else{
  mysqli_stmt_bind_param($stmt, "i", $student_id);
  mysqli_stmt_execute($stmt);
  if(mysqli_stmt_bind_result($stmt, $username)){
    mysqli_stmt_fetch($stmt);
    echo $username;
  }
}

?>
