<?php

 $connection = pg_connect("host=localhost dbname=helpdesk user=postgres password=admin");

 if (!$connection)
 {
   echo "Couldn't make a connection!";
 }

?>
