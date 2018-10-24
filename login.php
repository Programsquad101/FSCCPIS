<?php
  require_once 'scripts/database.php';
  require_once 'scripts/app_config.php';

  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $username = filter_var($username, FILTER_SANITIZE_STRING);
  $username = mysqli_real_escape_string($con, $username);

  if(isset($_POST['student-btn'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT username,password,student_id FROM tblStudents WHERE username=?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      set_error_handler("errorHandler");
      trigger_error("Prepare statment with verifying username and password failed.");
    } else{
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      if(mysqli_stmt_bind_result($stmt, $data_username,$data_password,$student_id)){
        mysqli_stmt_fetch($stmt);
        if($username === $data_username){
          if(password_verify($password, $data_password)){
            session_start();
            $_SESSION['student_id'] = $student_id;
            header("Location:student");
            exit();
          } else{
            echo "password wrong";
          }
        } else{
          echo "username wrong";
        }
      }
    }
  }

  if(isset($_POST['faculty-btn'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT username,password,advisor_id FROM tblAdvisors WHERE username=?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      set_error_handler("errorHandler");
      trigger_error("Prepare statment with verifying username and password failed.");
    } else{
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      if(mysqli_stmt_bind_result($stmt, $data_username,$data_password,$advisor_id)){
        mysqli_stmt_fetch($stmt);
        if($username === $data_username){
          if(password_verify($password, $data_password)){
            session_start();
            $_SESSION['advisor_id'] = $advisor_id;
            header("Location:advisor");
            exit();
          } else{
            echo "password wrong";
          }
        } else{
          echo "username wrong";
        }
      }
    }
  }

  if(isset($_POST['tutor-btn'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT username,password,tutor_id FROM tblTutors WHERE username=?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      set_error_handler("errorHandler");
      trigger_error("Prepare statment with verifying username and password failed.");
    } else{
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      if(mysqli_stmt_bind_result($stmt, $data_username,$data_password,$tutor_id)){
        mysqli_stmt_fetch($stmt);
        if($username === $data_username){
          if(password_verify($password, $data_password)){
            session_start();
            $_SESSION['tutor_id'] = $tutor_id;
            header("Location:tutor");
            exit();
          } else{
            echo "password wrong";
          }
        } else{
          echo "username wrong";
        }
      }
    }
  }


?>
