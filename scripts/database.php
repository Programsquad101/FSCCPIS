<?php

  require_once 'app_config.php';


  $con = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME)
    or die(mysqli_error($con));


?>
