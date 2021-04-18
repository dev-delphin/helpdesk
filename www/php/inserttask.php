<?php
    require 'connection.php';
    require 'config.php';
    $theme = pg_escape_string($_POST['theme']);
    $descriptions = pg_escape_string($_POST['descriptions']);
    if ($_POST['termdate'] > ""){
        $termdate = $_POST['termdate'];
        $queryinsert = pg_query($connection,"INSERT INTO tasks (theme, descriptions, createdate, stage ,termdate) VALUES ('$theme','$descriptions', current_date, '1', $termdate)");
    } else {
        $queryinsert = pg_query($connection,"INSERT INTO tasks (theme, descriptions, createdate, stage) VALUES ('$theme','$descriptions', current_date, '1')");
    }
    pg_close($connection);
?>