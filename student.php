<?php

require_once 'scripts/database.php';
require_once 'scripts/app_config.php';

session_start();
$student_id = $_SESSION['student_id'];

$sql = "SELECT ramID,firstName,lastName,address,phone,email,lat,lng FROM tblStudents WHERE student_id = ?;";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "ERROR PREPARE";
} else{
  mysqli_stmt_bind_param($stmt, "i", $student_id);
  mysqli_stmt_execute($stmt);
  if(mysqli_stmt_bind_result($stmt, $ramID, $firstName, $lastName, $address, $phone, $email,$studentLat, $studentLng)){
    mysqli_stmt_fetch($stmt);
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
    <div> Logout, <?php echo escape($firstName) . ' ' . escape($lastName) ?> </div>
  </div>

  <div id="content">
    <div id="student-content">
      <h1> Student Information </h1>
      <p> <b>Name:</b> <?php echo escape($firstName) . ' ' . escape($lastName) ?> </p>
      <p> <b>Address:</b> <?php echo escape($address) ?></p>
      <p> <b>Phone:</b> <?php echo escape($phone) ?> </p>
    </div>

    <h1> Advisors </h1>
    <div id="advisor-content">
      <?php
      $sql = "SELECT firstName,lastName,email FROM tblAdvisors;";
      $stmt = mysqli_stmt_init($con);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "ERROR PREPARE";
      } else{
        mysqli_stmt_execute($stmt);
        if(!mysqli_stmt_bind_result($stmt, $advisor_firstName, $advisor_lastName, $advisor_email)){
          echo "Error binding result";
          } else{
            $advisor_firstName = htmlspecialchars($advisor_firstName, ENT_QUOTES, 'UTF-8');
            $advisor_lastName = htmlspecialchars($advisor_lastName, ENT_QUOTES, 'UTF-8');
            $advisor_email = htmlspecialchars($advisor_email, ENT_QUOTES, 'UTF-8');
            while(mysqli_stmt_fetch($stmt)){
              echo "
                <div class='advisors'>
                <div> $advisor_firstName $advisor_lastName </div>
                <div> $advisor_email </div>
              ";
            }
        }
      }
      ?>
    </div>
    <h1> Tutor </h1>

    <div id="tutor-content">
      <?php
      $sql = "SELECT firstName, lastName, address, pricing, status, email, skills,
       ( 3959 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distance FROM tblTutors t
        JOIN tblSkills s ON  t.tutor_id = s.tutor_id
        ORDER BY distance LIMIT 0, 20;";
      $stmt = mysqli_stmt_init($con);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "ERROR PREPARE";
      } else{
        mysqli_stmt_bind_param($stmt, "ddd", $studentLat, $studentLng, $studentLat);
        mysqli_stmt_execute($stmt);
        if(!mysqli_stmt_bind_result($stmt, $tutor_firstName, $tutor_lastName, $tutor_address, $tutor_pricing, $tutor_status, $tutor_email, $skills, $distance)){
          echo "error, failed to bind results";
        }else{
        while(mysqli_stmt_fetch($stmt)){
          $distance = number_format((float)$distance, 2, '.', '');
          $tutor_firstName = htmlspecialchars($tutor_firstName, ENT_QUOTES, 'UTF-8');
          $tutor_lasttName = htmlspecialchars($tutor_lastName, ENT_QUOTES, 'UTF-8');
          $tutor_email = htmlspecialchars($tutor_email, ENT_QUOTES, 'UTF-8');
          $tutor_address = htmlspecialchars($tutor_address, ENT_QUOTES, 'UTF-8');

          echo "
          <div class='tutors'>
          <div> $distance Miles </div>
          <div><b>Name:</b> $tutor_firstName $tutor_lastName</div>
          <div><b>Address:</b> $tutor_address</div>
          <div><b>Email:</b> $tutor_email</div>
          <div><b>Status:</b>  $tutor_status</div>
          <div><b>Pricing:</b>  $tutor_pricing</div>
          <div><b>Skills:</b> $skills </div>
          </div>
          ";
          }
        }
      }


    ?>
    </div>
  </div>

</div>
</body>
</html>
