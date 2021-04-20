<?php
    require 'connection.php';
    require 'config.php';
    $theme = pg_escape_string($_POST['theme']);
    $descriptions = pg_escape_string($_POST['descriptions']);
    $date = date("d.m.Y");
    if (pg_escape_string($_POST['termdate']) && pg_escape_string($_POST['usersfromdb'])){
        $termdate = pg_escape_string($_POST['termdate']);
        $usersfromdb = pg_escape_string($_POST['usersfromdb']);
        $dateterm = date("d.m.Y", (time()+3600*24*$termdate));
        $queryinsert = pg_query($connection,"INSERT INTO tasks (theme, descriptions, termdate, createdate, responsible, stage) VALUES ('$theme', '$descriptions', '$dateterm', '$date', '$usersfromdb', '1')");
    } else if (pg_escape_string($_POST['termdate']) > 0 ){
        $termdate = pg_escape_string($_POST['termdate']);
        $dateterm = date("d.m.Y", (time()+3600*24*$termdate));
        $queryinsert = pg_query($connection,"INSERT INTO tasks (theme, descriptions, termdate, createdate, stage) VALUES ('$theme', '$descriptions', '$dateterm', '$date', '1')");
    } else if (pg_escape_string($_POST['usersfromdb'])){
        $usersfromdb = pg_escape_string($_POST['usersfromdb']);
        $queryinsert = pg_query($connection,"INSERT INTO tasks (theme, descriptions, createdate ,responsible, stage) VALUES ('$theme', '$descriptions', '$date', '$usersfromdb','1')");
    } else {
        $queryinsert = pg_query($connection,"INSERT INTO tasks (theme, descriptions, createdate, stage) VALUES ('$theme','$descriptions', '$date', '1')");
    }
    pg_close($connection);
?>