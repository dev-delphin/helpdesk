<?php require 'D:/Programming/Projects/diplom_helpdesk/php/connection.php';
  include 'D:/Programming/Projects/diplom_helpdesk/php/config.php';
  echo '<html>';
    echo '<head>';
    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
      echo '<title>Пример авторизации на сайте</title>';
    echo '</head>';
    echo '<body>';

    //  if(AUTH) { //Если мы авторизированы

        echo 'Привет,';// echo $user['name'];
        echo '<a href="login.php?logout">Выход</a>';

    //  } else { //Если мы не авторизированы
      
      echo '<form name="login" action="" method="POST">';
          echo '<p>Имя пользователя: <input type="text" id="login" name="login" /></p>';
          echo '<p>Пароль: <input type="password" id="password" name="password" /></p>';
          echo '<p>Запомнить меня: <input type="checkbox" name="remember" /></p>';
        //  if(!empty($message)) {;
          echo '<p>'; //echo $message; echo '</p>';
          echo '<p><input type="submit" value="Вход" /></p>';
          
      //  }
      echo '</form>';
      if ($_POST["login"]) {echo "good";}
  //    }
    echo '</body>';
  echo '</html>';
 // echo $login;
  /* запрос выборки
  $sql = "select firstname from users";
  $result = pg_query($connection, $sql);
  while ($data = pg_fetch_array($result)){
    echo "{$data['firstname']} <br>";
  }
  */
?>
