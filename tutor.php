<?php

require_once 'scripts/database.php';

session_start();
$tutor_id = $_SESSION['tutor_id'];


$sql = "SELECT skills FROM tblSkills WHERE tutor_id = ?;";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "error skill prepare";
} else{
  mysqli_stmt_bind_param($stmt, "i", $tutor_id);
  mysqli_stmt_execute($stmt);
  if(!mysqli_stmt_bind_result($stmt, $skills)){
    echo "error binding skills";
  } else{
    mysqli_stmt_fetch($stmt);
  }
}

$sql = "SELECT username, firstName, lastName, address, pricing, status, email FROM tblTutors WHERE tutor_id = ?;";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo $tutor_id;
  echo "ERROR PREPARE";
} else{
  mysqli_stmt_bind_param($stmt, "i", $tutor_id);
  mysqli_stmt_execute($stmt);
  if(!mysqli_stmt_bind_result($stmt, $username, $firstName, $lastName, $address, $pricing, $status, $email)){
    echo "error binding";
  } else{
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

  <link rel="stylesheet" href="css/tutor.css">
  <link rel="stylesheet" media="(min-width:1200px)" href="css/tutor-desktop.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="js/tutor.js"></script>

</head>
<body>

<?php escape($username); ?>
<?php escape($firstName); ?>
<?php escape($lastName); ?>
<?php escape($address); ?>
<?php escape($pricing); ?>
<?php escape($status); ?>
<?php escape($email); ?>
<?php escape($skills); ?>

<form method="POST" action="update_tutor.php">
  <label for="username"> Username </label>
  <input type="text" name="username">

  <label for="password"> Password </label>
  <input type="password" name="password">

  <label for="pricing"> Pricing </label>
  <input type="text" name="pricing">

  <label for="email"> Email </label>
  <input type="email" name="email">

  <label for="staus"> Status </label>
  <select name="status">
    <option value="Teacher">Teacher </option>
    <option value="Student">Student </option>
    <option value="Other">Other </option>
  </select>

  <label for="skills"> Skills </label>
  <input type="text" name="skills">

  <input type="submit" name="submit"> 
</form>

</body>
