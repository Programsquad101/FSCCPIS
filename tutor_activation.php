<?php
require_once 'scripts/app_config.php';
require_once 'scripts/database.php';

$accept = 'Accept';
$decline = 'Decline';
$url = "http///$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$tutor_id = substr($url, -2);

if(isset($_POST['accept'])){
  $sql = "UPDATE tblTutors SET allowed = ? WHERE tutor_id = ?;";
  $stmt = mysqli_stmt_init($con);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "prepare for accept no work";
  } else{
    mysqli_stmt_bind_param($stmt, "si", $accept, $tutor_id);
    mysqli_stmt_execute($stmt);
    header("Location: admin");
  }
}

if(isset($_POST['decline'])){
  $sql = "DELETE FROM tblTutors WHERE tutor_id = ?;";
  $stmt = mysqli_stmt_init($con);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "prepare for accept no work";
  } else{
    mysqli_stmt_bind_param($stmt, "i", $tutor_id); 
    mysqli_stmt_execute($stmt);
    header("Location: admin");
  }
}


?>
