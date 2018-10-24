<?php


if(!isset($_POST['submit'])){
  echo "Error";
} else{
require_once 'scripts/database.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['address'];
$pricing = $_POST['pricing'];
$status = $_POST['status'];
$email = $_POST['email'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$skills = $_POST['skills'];

/*
$address_check = $lat + $lng;
if($address_check == 0){
  header("Location:signup.php?address=error");
  exit();
}
*/

$username = filter_var($username, FILTER_SANITIZE_STRING);
$firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
$lastName = filter_var($lastName, FILTER_SANITIZE_STRING);
$pricing = filter_var($pricing, FILTER_SANITIZE_STRING);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$address = filter_var($address, FILTER_SANITIZE_STRING);
$skills = filter_var($skills, FILTER_SANITIZE_STRING);


/* double check if validation is good */


$username = mysqli_real_escape_string($con, $username);
$firstName = mysqli_real_escape_string($con, $firstName);
$lastName = mysqli_real_escape_string($con, $lastName);
$pricing = mysqli_real_escape_string($con, $pricing);
$email = mysqli_real_escape_string($con, $email);
$address = mysqli_real_escape_string($con, $address);
$skills = mysqli_real_escape_string($con, $skills);



$sql = "INSERT INTO tblTutors(username, password, firstName, lastName, address, lat, lng, pricing, status, email)VALUES(?,?,?,?,?,?,?,?,?,?);";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "error preparing";
  } else{
    mysqli_stmt_bind_param($stmt, "sssssddsss", $username, $password, $firstName, $lastName, $address, $lat, $lng, $pricing, $status, $email);
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
      $SESSION['tutor_id'] = $tutor_id;
      header("Location:tutor");
    }
  }
}


?>
