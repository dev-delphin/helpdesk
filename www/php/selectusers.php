<?php 
    require 'connection.php';
    require 'config.php';
    $queryusers = pg_query($connection,"SELECT login,priveleges FROM users WHERE priveleges != 'disabled'");
    $i = 0;
    while ($row = pg_fetch_assoc($queryusers))
    {
        $mymas[$i] = $row["login"];
        $i++;
    }
    foreach ($mymas as &$login) {
        echo("<option value='".$login."'>".$login."</option>");
    }
?>