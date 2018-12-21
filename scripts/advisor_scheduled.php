<?php
session_start();
$advisor_id = $_SESSION['advisor_id'];
require_once 'database.php';

$url = "http///$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$available_id = substr($url, strrpos($url, '?' )+1)."\n";
$available_id = substr($available_id.'/', 0, strpos($available_id, '/'));

$student_id = substr($url, strrpos($url, '/' )+1)."\n";

$sql = "SELECT availableDate, availableTime, room FROM tblAdvisorAvailable WHERE available_id =?;";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "Prepare no work";
} else{
  mysqli_stmt_bind_param($stmt, "i", $available_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $date, $time, $room);
  mysqli_stmt_fetch($stmt);
}

$sql = "INSERT INTO tblAdvisorScheduled(advisor_id, student_id, date, time, room)VALUES(?,?,?,?,?);";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "Prepare no work";
} else{
  mysqli_stmt_bind_param($stmt, "iisss", $advisor_id, $student_id, $date, $time, $room);
  mysqli_stmt_execute($stmt);
}

$sql = "DELETE FROM tblAdvisorAvailable WHERE available_id =?;";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "Prepare no work";
} else{
  mysqli_stmt_bind_param($stmt, "i", $available_id);
  mysqli_stmt_execute($stmt);
}

$sql = "DELETE FROM tblRequestAdvisorAppointment WHERE available_id =? AND advisor_id = ? AND student_id = ?;";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "Prepare no work";
} else{
  mysqli_stmt_bind_param($stmt, "iii", $available_id, $advisor_id, $student_id);
  mysqli_stmt_execute($stmt);
}

header("Location: ../advisor");

?>
