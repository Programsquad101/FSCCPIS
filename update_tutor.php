<?php

session_start();
if(empty($_SESSION['tutor_id'])){
  header("Location:scripts/error404");
  exit();
} else{
  require_once 'scripts/database.php';

  $tutor_id = $_SESSION['tutor_id'];

  if(!empty($_POST['username'])){
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);

    // Check if username is taken here //
    $username = mysqli_real_escape_string($con, $username);

    $sql = "UPDATE tblTutors SET username = ? WHERE tutor_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "error preparing username update";
    } else{
      mysqli_stmt_bind_param($stmt, "si", $username, $tutor_id);
      mysqli_stmt_execute($stmt);
    }
  }

  if(!empty($_POST['old_password']) && !empty($_POST['new_password'])){
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    $sql = "SELECT password FROM tblTutors WHERE tutor_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "error with prepare updating password";
    } else{
      mysqli_stmt_bind_param($stmt, "i", $tutor_id);
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
          $sql = "UPDATE tblTutors SET password = ? WHERE tutor_id = ?;";
          $stmt = mysqli_stmt_init($con);
          if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "prepare failed";
          } else{
            mysqli_stmt_bind_param($stmt, "si", $password, $tutor_id);
            mysqli_stmt_execute($stmt);
          }
        }
      }
    }
  }

  if(!empty($_POST['pricing'])){
    $pricing = $_POST['pricing'];
    $pricing = filter_var($pricing, FILTER_SANITIZE_STRING);

    // Check if username is taken here //
    $pricing = mysqli_real_escape_string($con, $pricing);

    $sql = "UPDATE tblTutors SET pricing = ? WHERE tutor_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "error preparing pricing update";
    } else{
      mysqli_stmt_bind_param($stmt, "si", $pricing, $tutor_id);
      mysqli_stmt_execute($stmt);
    }
  }


  if(!empty($_POST['status'])){
    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);

    // Check if username is taken here //
    $status = mysqli_real_escape_string($con, $status);

    $sql = "UPDATE tblTutors SET status = ? WHERE tutor_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "error preparing status update";
    } else{
      mysqli_stmt_bind_param($stmt, "si", $status, $tutor_id);
      mysqli_stmt_execute($stmt);
    }
  }

  if(!empty($_POST['email'])){
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Check if username is taken here //
    $email = mysqli_real_escape_string($con, $email);

    $sql = "UPDATE tblTutors SET email = ? WHERE tutor_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "error preparing email update";
    } else{
      mysqli_stmt_bind_param($stmt, "si", $email, $tutor_id);
      mysqli_stmt_execute($stmt);
    }
  }

  if(!empty($_POST['skills'])){
    $skills = $_POST['skills'];
    $skills = filter_var($skills, FILTER_SANITIZE_STRING);

    // Check if username is taken here //
    $skills = mysqli_real_escape_string($con, $skills);

    $sql = "UPDATE tblSkills SET skills = ? WHERE tutor_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "error preparing skills update";
    } else{
      mysqli_stmt_bind_param($stmt, "si", $skills, $tutor_id);
      mysqli_stmt_execute($stmt);
    }
  }

header("Location: tutor");
exit();
}




?>
