<!DOCTYPE html>

<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> CPIS System for farmingdale students</title>
  <meta name = "description" content = "Check out what is going on with the cpis department at farmingdale">
  <meta name="author" content="cpis.com">

  <link rel="stylesheet" href="css/tutorSignup.css">
  <link rel="stylesheet" media="(min-width:1200px)" href="css/tutorSignup-desktop.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="js/tutor_signup.js"></script>

</head>
<body>
  <div id="wrapper">
    <h1> Tutor sign up</h1>
    <form method="POST" action="create_tutor.php">
      <input type="text" name="username" placeholder="username">
      <input type="password" name="password" placeholder="password">
      <input type="text" name="firstName" placeholder="firstName">
      <input type="text" name="lastName" placeholder="lastName">
      <input type="text" id="location-input" name="address" placeholder="address">
      <!-- This is where geocde takes the address and finds lat and long. lat and long does not print to user. css is display:none !-->
      <div id="full-address"></div>
      <div id="lat"></div>
      <div id="lng"></div>

      <!-- END GEOCODE !-->
      <input type="text" name="pricing" placeholder="pricing">
      <select name="status">
        <option value="Student">Student</option>
        <option value="Teacher">Teacher</option>
      </select>
      <input type="email" name="email" placeholder="email">
      <input type="text" name="skills" placeholder="skills">

      <input type="submit" name="submit">
    </form>
  </div>
</body>
</html>
