<?php
  session_start();

  require_once 'database.php';

  $url = "http///$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $id = substr($url, strrpos($url, '?' )+1)."\n";


  if(empty($_SESSION['student_id'])){

  } else{
    $sql = "DELETE FROM tblAdvisorScheduled WHERE schedule_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "prepare fial";
    } else{
      mysqli_stmt_bind_param($stmt, "i", $id);
      mysqli_stmt_execute($stmt);
      header("Location: ../student");
      exit();
    }
  }


  if(empty($_SESSION['advisor_id'])){

  } else{
    $sql = "DELETE FROM tblAdvisorScheduled WHERE schedule_id = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "prepare fial";
    } else{
      mysqli_stmt_bind_param($stmt, "i", $id);
      mysqli_stmt_execute($stmt);
      header("Location: ../advisor");
      exit();
    }  }


?>
