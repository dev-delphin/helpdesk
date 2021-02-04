<?php
  require "config.php";
  $connection = pg_connect("host='$servername' dbname='$database' user='$username' password='$password'");
  //$connection = pg_connect("host=localhost dbname=helpdesk user=postgres password=admin");

 if (!$connection)
 {
   echo "Couldn't make a connection!";
 }
?>
