<?php
    require 'connection.php';
    require 'config.php';
    $theme = pg_escape_string($_POST['theme']);
    $descriptions = pg_escape_string($_POST['descriptions']);
    $date = date("d.m.Y");
    $ip = $_SERVER['REMOTE_ADDR'];
    $querypublisher = pg_query($connection, "SELECT username FROM sessions WHERE ip = '$ip';");
    while ($publ = pg_fetch_assoc($querypublisher)){
        $publisher = $publ['username'];
    }
    if (pg_escape_string($_POST['termdate']) && pg_escape_string($_POST['usersfromdb'])){
        $termdate = pg_escape_string($_POST['termdate']);
        $usersfromdb = pg_escape_string($_POST['usersfromdb']);
        $dateterm = date("d.m.Y", (time()+3600*24*$termdate));
        $queryinsert = pg_query($connection,"INSERT INTO tasks (theme, descriptions, publisher, termdate, createdate, responsible, stage) VALUES ('$theme', '$descriptions', '$publisher', '$dateterm', '$date', '$usersfromdb', '1');");
    } else if (pg_escape_string($_POST['termdate']) > 0 ){
        $termdate = pg_escape_string($_POST['termdate']);
        $dateterm = date("d.m.Y", (time()+3600*24*$termdate));
        $queryinsert = pg_query($connection,"INSERT INTO tasks (theme, descriptions, publisher, termdate, createdate, stage) VALUES ('$theme', '$descriptions', '$publisher', '$dateterm', '$date', '1');");
    } else if (pg_escape_string($_POST['usersfromdb'])){
        $usersfromdb = pg_escape_string($_POST['usersfromdb']);
        $queryinsert = pg_query($connection,"INSERT INTO tasks (theme, descriptions, publisher, createdate ,responsible, stage) VALUES ('$theme', '$descriptions', '$publisher', '$date', '$usersfromdb','1');");
    } else {
        $queryinsert = pg_query($connection,"INSERT INTO tasks (theme, descriptions, publisher, createdate, stage) VALUES ('$theme','$descriptions', '$publisher', '$date', '1');");
    }
    pg_close($connection);
?>