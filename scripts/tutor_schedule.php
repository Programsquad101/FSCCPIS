<?php
session_start();
$tutor_id = $_SESSION['tutor_id'];
require_once 'database.php';

$url = "http///$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$available_id = substr($url, strrpos($url, '?' )+1)."\n";
$available_id = substr($available_id.'/', 0, strpos($available_id, '/'));

$student_id = substr($url, strrpos($url, '/' )+1)."\n";

$sql = "SELECT availableDate, availableTime FROM tblTutorAvailable WHERE available_id =?;";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "Prepare no work";
} else{
  mysqli_stmt_bind_param($stmt, "i", $available_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $date,$time);
  mysqli_stmt_fetch($stmt);
}

$sql = "INSERT INTO tblTutorScheduled(tutor_id, student_id, date, time)VALUES(?,?,?,?);";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "Prepare no work";
} else{
  mysqli_stmt_bind_param($stmt, "iiss", $tutor_id, $student_id, $date, $time);
  mysqli_stmt_execute($stmt);
}

$sql = "DELETE FROM tblTutorAvailable WHERE available_id =?;";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "Prepare no work";
} else{
  mysqli_stmt_bind_param($stmt, "i", $available_id);
  mysqli_stmt_execute($stmt);
}

$sql = "DELETE FROM tblRequestTutorAppointment WHERE available_id =? AND tutor_id = ? AND student_id = ?;";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "Prepare no work";
} else{
  mysqli_stmt_bind_param($stmt, "iii", $available_id, $tutor_id, $student_id);
  mysqli_stmt_execute($stmt);
}

header("Location:../tutor.php");


?>
