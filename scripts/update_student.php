<?php

session_start();
if(empty($_SESSION['student_id'])){
  header("Location:scripts/error404");
  exit();
} else{
  require_once 'database.php';

  $student_id = $_SESSION['student_id'];

  if(!empty($_POST['username'])){
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);

    // Check if username is taken here //
    $username = mysqli_real_escape_string($con, $username);

    $sql = "UPDATE tblStudents SET username = ? WHERE student_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "error preparing username update";
    } else{
      mysqli_stmt_bind_param($stmt, "si", $username, $student_id);
      mysqli_stmt_execute($stmt);
    }
  }

  if(!empty($_POST['old_password']) && !empty($_POST['new_password'])){
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    $sql = "SELECT password FROM tblStudents WHERE student_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "error with prepare updating password";
    } else{
      mysqli_stmt_bind_param($stmt, "i", $student_id);
      mysqli_stmt_execute($stmt);
      if(!mysqli_stmt_bind_result($stmt, $password)){
        echo "failed to bind result";
      } else{
        mysqli_stmt_fetch($stmt);
        if(!password_verify($old_password, $password)){
          header("Location: tutor.php?password=error");
          exit();
        } else{
          $password = password_hash($new_password, PASSWORD_DEFAULT);
          $sql = "UPDATE tblStudents SET password = ? WHERE student_id = ?;";
          $stmt = mysqli_stmt_init($con);
          if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "prepare failed";
          } else{
            mysqli_stmt_bind_param($stmt, "si", $password, $student_id);
            mysqli_stmt_execute($stmt);
          }
        }
      }
    }
  }

  if(!empty($_POST['email'])){
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Check if username is taken here //
    $email = mysqli_real_escape_string($con, $email);

    $sql = "UPDATE tblStudents SET email = ? WHERE student_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "error preparing email update";
    } else{
      mysqli_stmt_bind_param($stmt, "si", $email, $student_id);
      mysqli_stmt_execute($stmt);
    }
  }


header("Location: ../student");
exit();
}




?>
