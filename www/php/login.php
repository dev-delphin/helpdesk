<?php
    require 'connection.php';
    require 'config.php';
    $querylogin = pg_query($connection,"SELECT pwd FROM users WHERE login='".pg_escape_string($connection,$_POST['login'])."'LIMIT 1");
    if (pg_num_rows($querylogin) > 0) {
        $datapwd = pg_fetch_assoc($querylogin);
        if($datapwd['pwd'] === $_POST['password']){
            $queryid = pg_query($connection,"SELECT id, login FROM users WHERE login='".pg_escape_string($connection,$_POST['login'])."'LIMIT 1");
            $dataid = pg_fetch_assoc($queryid); 
            $id = $dataid['login'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $queryinsert = pg_query($connection,"INSERT INTO sessions (username, ip) VALUES ('$id','$ip')");              
            echo "login";
        }
    } else {
        echo "error";
        exit;
    }
pg_close($connection);
?>