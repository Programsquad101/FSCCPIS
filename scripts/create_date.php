<?php
session_start();
require_once 'database.php';

if(isset($_POST['submit'])){
$advisor_id = $_SESSION['advisor_id'];
$availableDate = $_POST['availableDate'];
$availableTime = $_POST['availableTime'];
$room = $_POST['room'];

$availableDate = filter_var($availableDate, FILTER_SANITIZE_STRING);
$availableTime = filter_var($availableTime, FILTER_SANITIZE_STRING);
$room = filter_var($room, FILTER_SANITIZE_STRING);

$availableDate = mysqli_real_escape_string($con, $availableDate);
$availableTime = mysqli_real_escape_string($con, $availableTime);
$room = mysqli_real_escape_string($con, $room);

$sql = "INSERT INTO tblAdvisorAvailable(advisor_id, availableDate,availableTime, room)
VALUES(?,?,?,?);";
$stmt = mysqli_stmt_init($con);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "no prepare";
  } else{
    mysqli_stmt_bind_param($stmt, "isss", $advisor_id, $availableDate, $availableTime, $room);
    mysqli_stmt_execute($stmt);
    $_SESSION['success'] = "Date Added";
    header("Location:../advisor.php");
  }
}

if(isset($_POST['submitTutor'])){
  $tutor_id = $_SESSION['tutor_id'];
  $availableDate = $_POST['availableDate'];
  $availableTime = $_POST['availableTime'];

  $availableDate = filter_var($availableDate, FILTER_SANITIZE_STRING);
  $availableTime = filter_var($availableTime, FILTER_SANITIZE_STRING);

  $availableDate = mysqli_real_escape_string($con, $availableDate);
  $availableTime = mysqli_real_escape_string($con, $availableTime);

  $sql = "INSERT INTO tblTutorAvailable(tutor_id, availableDate, availableTime)
  VALUES(?,?,?);";
  $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "no prepare";
    } else{
      mysqli_stmt_bind_param($stmt, "iss", $tutor_id, $availableDate, $availableTime);
      mysqli_stmt_execute($stmt);
      $_SESSION['success'] = "Date Added";
      header("Location:../tutor.php");
    }
}
?>
