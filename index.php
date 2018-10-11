<!DOCTYPE html>

<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> CPIS System for farmingdale students</title>
  <meta name = "description" content = "Check out what is going on with the cpis department at farmingdale">
  <meta name="author" content="cpis.com">

  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" media="(min-width:1200px)" href="css/index-desktop.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="js/index.js"></script>

</head>
<body>
  <div id="wrapper">

    <div id="header">
      <p>Farmingdale CPIS</p>
      <p> Pick what you are and log in below</p>
    </div>

    <div id="selection">

      <div id="student-btn" class="selection-btn"> Student </div>
        <form method="POST" id="student" action="login.php">

          <label for="username">Username</label>
          <input type="text" class="text-input" name="username">

          <label for="password">Password</label>
          <input type="password" class="text-input" name="password">

          <button type="submit" class="submit-btn" name="student-btn">Login</button>
        </form>

      <div id="faculty-btn" class="selection-btn"> Advisor </div>
        <form method="POST" id="faculty" action="login.php">

          <label for="username">Username</label>
          <input type="text" class="text-input" name="username">

          <label for="password">Password</label>
          <input type="password" class="text-input" name="password">

          <button type="submit" class="submit-btn" name="faculty-btn">Login</button>
      </form>

      <div id="tutor-btn" class="selection-btn"> Tutor </div>
        <form method="POST" id="tutor" action="login.php">
          <label for="username">Username</label>
          <input type="text" class="text-input" name="username">

          <label for="password">Password</label>
          <input type="password" class="text-input" name="password">
          <button type="submit" class="submit-btn" name="tutor-btn">Login</button>

      </form>

    </div>




  </div>
</body>
</html>
