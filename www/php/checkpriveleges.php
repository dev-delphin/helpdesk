<?php
require 'connection.php';
require 'config.php';
$ip = $_SERVER['REMOTE_ADDR'];
$queryusername = pg_query($connection,"SELECT username FROM sessions where ip = '$ip';");
while($row = pg_fetch_assoc($queryusername)){
    $name = $row['username'];
}
$queryprivelege = pg_query($connection,"SELECT privelege FROM users where login = '$name';");
while($row = pg_fetch_assoc($queryprivelege)){
    $privelegeid = $row['privelege'];
    //echo ($privelegeid);
}
$queryprivelegevalue = pg_query($connection,"SELECT privelegevalue FROM priveleges where id = '$privelegeid';");
while($row = pg_fetch_assoc($queryprivelegevalue)){
    $value = $row['privelegevalue'];
}
echo ($value);
?>