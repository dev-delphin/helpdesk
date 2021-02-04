<?php
require 'connection.php';
require 'config.php';
$queryprivege = pg_query($connection,"SELECT priveleges.privelegevalue FROM users JOIN priveleges ON users.privelege=priveleges.id AND 
                                    users.login='".pg_escape_string($connection,$_POST['login'])."' LIMIT 1");
    //$datalogin = pg_fetch_assoc($queryprivege);
if (pg_num_rows($queryprivege) > 0) {
    $datalogin = pg_fetch_assoc($queryprivege);
} else {
    echo -1;
    exit;
}
if($datalogin['privelegevalue'] == 3){
    echo 3;
    exit;
}
else if($datalogin['privelegevalue'] == 2){
    echo 2;
    exit;
}
else if($datalogin['privelegevalue'] == 1){
    echo 1;
    exit;
}
else if($datalogin['privelegevalue'] == 0){
    echo 0;
    exit;
}
?>