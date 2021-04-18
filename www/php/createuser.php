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
    /*check login and email if exist false*/
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $querylogin = pg_query($connection,"SELECT login FROM users WHERE login='".pg_escape_string($connection,$_POST['login'])."'LIMIT 1");
    //$datalogin = pg_fetch_assoc($querylogin);
    if (pg_num_rows($querylogin) > 0) {
        $datalogin = pg_fetch_assoc($querylogin);
    } else {
        echo "error";
        exit;
    }
    //запрос логина если логин верен то запрос пароля иначче еррор
    if($datalogin['login'] === $_POST['login']){
        echo "error";
        exit;
    }
    else {
        echo "error";
        exit;
    }

        /*
        создать сессию записать в таблицу с хэш
        */


    // Сравниваем пароли
   /* if($data['pwd'] === md5(md5($_POST['pwd'])))
    {
        // Генерируем случайное число и шифруем его
      //  $hash = md5(generateCode(10));

/*     // Записываем в БД новый хеш авторизации и IP
        pg_query($connection, "UPDATE users SET user_hash='".$hash."' WHERE user_id='".$data['user_id']."'");

        // Ставим куки
        setcookie("id", $data['user_id'], time()+60*60*24*30, "/");
        setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!!

        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: check.php"); exit();
        //header("Location: createnewuser.html"); exit();
    }
    /*else
    {
        print "Вы ввели неправильный логин/пароль";
    }*/
//}
pg_close($connection);
?>