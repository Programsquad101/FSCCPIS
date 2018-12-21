<?php
session_start();
$student_id = $_SESSION['student_id'];
require_once 'database.php';

$url = "http///$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$advisor_id = substr($url, strrpos($url, '?' )+1)."\n";
$advisor_id = substr($advisor_id.'/', 0, strpos($advisor_id, '/'));

$available_id = substr($url, strrpos($url, '/' )+1)."\n";

$sql = "INSERT INTO tblRequestAdvisorAppointment(advisor_id,available_id,student_id) VALUES(?,?,?);";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "no prepare";
} else{
    mysqli_stmt_bind_param($stmt, "iii", $advisor_id, $available_id, $student_id);
    mysqli_stmt_execute($stmt);
    header("Location:../student");
}




?>
