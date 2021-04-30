<?php
    require 'connection.php';
    require 'config.php';
    $login = pg_escape_string($_POST['login']);
    $password = pg_escape_string($_POST['password']);
    $email = pg_escape_string($_POST['email']);
    $privelege = pg_escape_string($_POST['privelege']);
    $description  = pg_escape_string($_POST['description']);
    $queryselectprivelege = pg_query($connection,"SELECT id FROM priveleges WHERE privelegename = '$privelege'");
    while ($row = pg_fetch_assoc($queryselectprivelege)){
        $privel = $row['id'];
    }
    $querycountusers = pg_query($connection,"SELECT COUNT(*) FROM users;");
    while ($row = pg_fetch_assoc($querycountusers)){
        $count = $row['count'] + 1;
    }
    $queryinsert = pg_query($connection,"INSERT INTO users VALUES ('$count','$login','$password', '$email', '$privel', '$description')");
    pg_close($connection);
?>