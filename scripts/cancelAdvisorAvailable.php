<?php
require_once 'database.php';

$url = "http///$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$available_id = substr($url, strrpos($url, '?' )+1)."\n";

$sql = "DELETE FROM tblAdvisorAvailable WHERE available_id = ?;";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "no prepare";
} else{
  mysqli_stmt_bind_param($stmt, "i", $available_id);
  mysqli_stmt_execute($stmt);
  header("Location:../advisor");
}



?>
