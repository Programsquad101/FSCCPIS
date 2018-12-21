<?php

session_start();
if(empty($_SESSION['advisor_id'])){
  header("Location:scripts/error404");
  exit();
} else{
  require_once 'database.php';

  $advisor_id = $_SESSION['advisor_id'];

  if(!empty($_POST['username'])){
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);

    // Check if username is taken here //
    $username = mysqli_real_escape_string($con, $username);

    $sql = "UPDATE tblAdvisors SET username = ? WHERE advisor_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "error preparing username update";
    } else{
      mysqli_stmt_bind_param($stmt, "si", $username, $advisor_id);
      mysqli_stmt_execute($stmt);
    }
  }

  if(!empty($_POST['old_password']) && !empty($_POST['new_password'])){
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    $sql = "SELECT password FROM tblAdvisors WHERE advisor_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "error with prepare updating password";
    } else{
      mysqli_stmt_bind_param($stmt, "i", $advisor_id);
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
          $sql = "UPDATE tblAdvisors SET password = ? WHERE advisor_id = ?;";
          $stmt = mysqli_stmt_init($con);
          if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "prepare failed";
          } else{
            mysqli_stmt_bind_param($stmt, "si", $password, $advisor_id);
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

    $sql = "UPDATE tblAdvisors SET email = ? WHERE advisor_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "error preparing email update";
    } else{
      mysqli_stmt_bind_param($stmt, "si", $email, $advisor_id);
      mysqli_stmt_execute($stmt);
    }
  }


header("Location: ../advisor");
exit();
}




?>
