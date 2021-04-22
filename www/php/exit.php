<?php
    require 'connection.php';
    require 'config.php';
    $ip = $_SERVER['REMOTE_ADDR'];
    $queryexit = pg_query($connection,"DELETE FROM sessions WHERE ip='$ip'");
    echo "ok";
?>