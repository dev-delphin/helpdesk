<?php
    require 'connection.php';
    require 'config.php';
    $ip = $_SERVER['REMOTE_ADDR'];
    $querycheck = pg_query($connection,"SELECT id, username FROM sessions WHERE ip='$ip'LIMIT 1");
    if (pg_num_rows($querycheck) > 0){
        while($fetchusername = pg_fetch_assoc($querycheck)){
            $echousername = $fetchusername['username']; 
        }
        echo $echousername; 
    } else {echo "nook";}
?>