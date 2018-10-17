<?php

define("DATABASE_HOST", "127.0.0.1");
define("DATABASE_USERNAME", "root");
define("DATABASE_PASSWORD", "newpassword");
define("DATABASE_NAME", "cpis");

function escape($string){
  echo htmlspecialchars($string, ENT_QUOTES, "UTF-8");
}

?>
