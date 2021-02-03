<?php
    require 'connection.php';
    require 'config.php';
// Страница авторизации

// Функция для генерации случайной строки
/*function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}*/
//$error = "-1";
//echo json_encode(array('done'=>-1));
//if(isset($_POST['dologin']))
//if(isset($_POST['login']) && $_POST['login'] && isset($_POST['pwd']) && $_POST['pwd'])
//{
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $querylogin = pg_query($connection,"SELECT pwd FROM users WHERE login='".pg_escape_string($connection,$_POST['login'])."'LIMIT 1");
    //$datapwd = pg_fetch_assoc($querylogin);
    if (pg_num_rows($querylogin) > 0) {
        $datapwd = pg_fetch_assoc($querylogin);
    } else {
        echo "error";
        exit;
    }
    //запрос логина если логин верен то запрос пароля иначче еррор
    if($datapwd['pwd'] === $_POST['password']){
        $queryprivege = pg_query($connection,"SELECT priveleges.privelegevalue FROM users JOIN priveleges ON users.privelege=priveleges.id AND 
                                    users.login='".pg_escape_string($connection,$_POST['login'])."' LIMIT 1");
        //$datalogin = pg_fetch_assoc($queryprivege);
        if (pg_num_rows($queryprivege) > 0) {
            $datalogin = pg_fetch_assoc($queryprivege);
        } else {
            echo "error";
            exit;
        }
        if($datalogin['privelegevalue'] == 3){
            echo "superadmin";
            exit;
        }
        else if($datalogin['privelegevalue'] == 2){
            echo "admin";
            exit;
        }
        else if($datalogin['privelegevalue'] == 1){
            echo "technik";
            exit;
        }
        else if($datalogin['privelegevalue'] == 0){
            echo "disabled";
            exit;
        }
    }   else {
        echo "error";
            exit;
        }


    // Сравниваем пароли
   /* if($data['pwd'] === md5(md5($_POST['pwd'])))
    {
        // Генерируем случайное число и шифруем его
      //  $hash = md5(generateCode(10));
/*
        if(!empty($_POST['not_attach_ip']))
        {
            // Если пользователя выбрал привязку к IP
            // Переводим IP в строку
            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
        }
*/
/*     // Записываем в БД новый хеш авторизации и IP
        pg_query($connection, "UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

        // Ставим куки
        setcookie("id", $data['user_id'], time()+60*60*24*30, "/");
        setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!!

        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: check.php"); exit();
        header("Location: createnewuser.html"); exit();
    }
    /*else
    {
        print "Вы ввели неправильный логин/пароль";
    }*/
//}
?>