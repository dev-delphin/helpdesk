<?php
require 'connection.php';
include 'config.php';
?>
<html> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="bootstrap.css">
        <style>
            .center{
                display: block; 
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12"><br><br></div>
            <div class="col-xs-3 col-sm-5 col-md-5 col-xl-3 center" style="border: 2px solid #26d368; border-radius: 15px;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 center" style="padding: 15px;">
                    <div>
                        <form method="POST">
                            <div class="form-group">
                                <p class="text-center" style="font-size: 25px;"><b>Логин</b> </p>            
                                <input type="text" name="login" class="form-control" style="font-size: 25px;" id="login" placeholder="Логин" required><br>
                                <p class="text-center" style="font-size: 25px;"><b>Пароль</b></p>
                                <input type="password" name="password" class="form-control" style="font-size: 25px;" id="pwd" placeholder="Пароль" required><br>
                            </div>
                            <button type="submit" name="dologin" class="btn btn-primary text-center center"><b style="font-size: 25px;">Войти</b></button>
                        </form>
                    </div>
                </div>
                <div>
                    <?php
                        if(isset($_POST['dologin']))
                        {
                            $error = "<div><p class='text-center' style='font-size: 25px;'>Неверный логин или пароль</p></div>";
                            // Вытаскиваем из БД запись, у которой логин равняеться введенному
                            $querylogin = pg_query($connection,"SELECT pwd FROM users WHERE login='".pg_escape_string($connection,$_POST['login'])."'LIMIT 1");
                            if (pg_num_rows($querylogin) > 0) {
                                $datapwd = pg_fetch_assoc($querylogin);
                            } else {
                                echo $error;
                                exit();
                            }
                            //запрос логина если логин верен то запрос пароля иначче еррор
                            if($datapwd['pwd'] === $_POST['password']){
                                $queryprivege = pg_query($connection,"SELECT priveleges.privelegevalue FROM users JOIN priveleges ON users.privelege=priveleges.id AND 
                                                            users.login='".pg_escape_string($connection,$_POST['login'])."' LIMIT 1");
                                $datalogin = pg_fetch_assoc($queryprivege);
                                /*while ($row = pg_fetch_assoc($querylogin)) {
                                    $row['pwd'];
                                }*/
                                if($datalogin['privelegevalue'] === 3){
                                    // НЕ ОТКРЫВАЕТ СТРАНИЦЫ
                                    header("Location: superadminpage.php");
                                    exit();
                                }
                                if($datalogin['privelegevalue'] === 2){
                                    header("Location: admin.html");
                                    exit();
                                }
                                if($datalogin['privelegevalue'] === 1){
                                    header("Location: technik.html");
                                    exit();
                                }
                                if($datalogin['privelegevalue'] === 0){
                                    echo "Ваша учетная запись заблокирована";
                                    exit();
                                }
                                exit();
                            } else {
                                echo $error;
                            }
                        } ?>
                </div>
            </div>
        </div>
    <script src="bootstrap.js"></script> 
    <script src="bootstrap_bundle.js"></script>
    <script src="pooper.js"></script>
    </body>
</html>