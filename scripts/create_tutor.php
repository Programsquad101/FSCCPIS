<?php
  if(isset($_POST['submit'])){
    require_once 'database.php';

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $skills = implode(',', $_POST['skills']);
    $pricing = $_POST['pricing'];
    $status = $_POST['status'];

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
    $lastName = filter_var($lastName, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $skills = filter_var($skills, FILTER_SANITIZE_STRING);
    $pricing = filter_var($pricing, FILTER_SANITIZE_STRING);
    $status = filter_var($status, FILTER_SANITIZE_STRING);

    $username = mysqli_real_escape_string($con, $username);
    $firstName = mysqli_real_escape_string($con, $firstName);
    $lastName = mysqli_real_escape_string($con, $lastName);
    $email = mysqli_real_escape_string($con, $email);
    $skills = mysqli_real_escape_string($con, $skills);
    $pricing = mysqli_real_escape_string($con, $pricing);
    $status = mysqli_real_escape_string($con, $status);

    $allowed = "Decline";
    $rating = 0;
    $totalAppointments = 0;
    $totalRatings = 0;

    $sql = "INSERT INTO tblTutors(username, password, firstName, lastName, email, pricing, status, allowed, rating, totalAppointments, totalRatings) VALUES(?,?,?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "no prepare";
      echo mysqli_error($con);
    } else{
      mysqli_stmt_bind_param($stmt, "sssssssssss", $username, $password, $firstName, $lastName, $email, $pricing, $status, $allowed, $rating, $totalAppointments, $totalRatings);
      mysqli_stmt_execute($stmt);
      $last_id = mysqli_insert_id($con);
      $sql = "INSERT INTO tblSkills(skills, tutor_id)VALUES(?,?);";
      $stmt = mysqli_stmt_init($con);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error prepare for skill";
      } else{
        mysqli_stmt_bind_param($stmt, "si", $skills, $last_id);
        mysqli_stmt_execute($stmt);
        session_start();
        $_SESSION['tutor_id'] = $last_id;
        header("Location:../tutor");
      }
    }
  }
?>
