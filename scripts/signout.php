<?php

session_start();
if(empty($_SESSION['tutor_id'] || $_SESSION["student_id"]|| $_SESSION["advisor_id"])){
  header("Location:scripts/error404.php");
  exit();
}
unset($_SESSION['tutor_id']);
unset($_SESSION['student_id']);
unset($_SESSION['advisor_id']);

header("Location: ../index");


?>
