<?php
  require_once 'scripts/database.php';
  require_once 'scripts/app_config.php';

  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $username = filter_var($username, FILTER_SANITIZE_STRING);
  $username = mysqli_real_escape_string($con, $username);

  if(isset($_POST['student-btn'])){
    $sql = "INSERT INTO tblStudents(username,password)VALUES(?,?);";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      echo "Error in prepare statment";
    } else{
      mysqli_stmt_bind_param($stmt, "ss", $username, $password);
      mysqli_stmt_execute($stmt);
      session_start();
      $_SESSION['student_id'] = $student_id;
      header("Location:student.php");
    }
  }

  if(isset($_POST['faculty-btn'])){
    $sql = "INSERT INTO tblAdvisors(username,password)VALUES(?,?);";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      echo "Error in prepare statment";
    } else{
      mysqli_stmt_bind_param($stmt, "ss", $username, $password);
      mysqli_stmt_execute($stmt);
      session_start();
      $_SESSION['advisor_id'] = $advisor_id;
      header("Location:advisor.php");
    }
  }

  if(isset($_POST['tutor-btn'])){
    $sql = "INSERT INTO tblTutors(username,password)VALUES(?,?);";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      echo "Error in prepare statment";
    } else{
      mysqli_stmt_bind_param($stmt, "ss", $username, $password);
      mysqli_stmt_execute($stmt);
      session_start();
      $_SESSION['tutor_id'] = $tutor_id;
      header("Location:tutor.php");
    }
  }


?>
