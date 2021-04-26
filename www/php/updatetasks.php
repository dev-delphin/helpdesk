<?php
    require 'connection.php';
    require 'config.php';
    $id = $_POST['id'];
    $date = date("d.m.Y");
    $ip = $_SERVER['REMOTE_ADDR'];
    $queryusertake = pg_query($connection, "SELECT username FROM sessions WHERE ip = '$ip';");
    while ($publ = pg_fetch_assoc($queryusertake)){
        $takertasks = $publ['username'];
    }
    $querytasks = pg_query($connection, "SELECT id, responsible, stage FROM tasks WHERE id = '$id';");
    while ($tsk = pg_fetch_assoc($querytasks)){
        $idtask = $tsk['id'];
        $responstask = $tsk['responsible'];
        $stagetask = $tsk['stage'];
    }
    if ($stagetask == 1 && $responstask == ''){
        $queryupdateinsert = pg_query($connection, "UPDATE tasks SET responsible = '$takertasks' WHERE id = '$id';");
        $queryupdateinsert = pg_query($connection, "UPDATE tasks SET editdate = '$date' WHERE id = '$id';");
        $queryupdate = pg_query($connection, "UPDATE tasks SET stage = '2' WHERE id = '$id';");
    } else if($stagetask == 1 && $responstask == $takertasks){
        $queryupdateinsert = pg_query($connection, "UPDATE tasks SET editdate = '$date' WHERE id = '$id';");
        $queryupdate = pg_query($connection, "UPDATE tasks SET stage = '2' WHERE id = '$id';");
    } else if ($stagetask == 2 && $responstask == $takertasks){
        $queryupdateinsert = pg_query($connection, "UPDATE tasks SET finishdate = '$date' WHERE id = '$id';");
        $queryupdate = pg_query($connection, "UPDATE tasks SET stage = '3' WHERE id = '$id';");
    } else {
        echo "error";
        return 0;
    }
    pg_close($connection);
?>