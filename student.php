<?php

require_once 'scripts/database.php';
require_once 'scripts/app_config.php';

session_start();
$student_id = $_SESSION['student_id'];

$sql = "SELECT username FROM tblStudents WHERE student_id = ?;";
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

<!DOCTYPE html>

<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> CPIS System for farmingdale students</title>
  <meta name = "description" content = "Check out what is going on with the cpis department at farmingdale">
  <meta name="author" content="cpis.com">

  <link rel="stylesheet" href="css/student.css">
  <link rel="stylesheet" media="(min-width:1200px)" href="css/student-desktop.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="js/index.js"></script>

</head>
<body>
<div id="wrapper">
  <div id="header">
    <div> Cpis </div>
    <div> Logout, <?php echo $name ?> </div>
  </div>

  <div id="content">
    <div id="student-content">
      <h1> Student Information </h1>
      <p> <b>Name:</b> James Carr </p>
      <p> <b>Address:</b> 631 Fenworth Blvd Franklin Square</p>
      <p> <b>Phone:</b> 773-555-2000 </p>
    </div>

    <div id="advisor-content">
      <h1> Advisors </h1>
      <p> <b>Name:</b> Sarah Lynn </p>
      <p> <b>Address:</b> 631 Fenworth Blvd Franklin Square</p>
      <p> <b>Email:</b> advisor@farmingdale.edu </p>
    </div>

    <div id="tutor-content">
      <h1> Tutor </h1>
      <p> <b>Name:</b> David Lee </p>
      <p> <b>Address:</b> 631 Fenworth Blvd Franklin Square</p>
      <p> <b>Email:</b> tutor@farmingdale.edu </p>
      <p> <b>Skills:</b> PHP, Pearl, BCS 250</p> 
    </div>
  </div>

</div>
</body>
</html>
