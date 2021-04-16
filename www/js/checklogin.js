$("#dologin").on("click", function(){
    var login = $("#login").val();
    var password = $("#password").val();
    
    if(login == ""){
        $("#error").text("Поле логина пустое");
        return false;
    } else if(password == ""){
        $("#error").text("Поле пароля пустое");
        return false;
    }

    $.ajax({
        url: "../php/login.php",
        type: "POST",
        cache: false,
        data: {"login": login, "password": password},
        dataType: "html",
        beforeSend: function(){
            $("#dologin").prop("disabled", true);
        },
        success: function(data){
            if (data == "superadmin"){
                location = "../html/main.html";
                return true;
            } else if (data == "admin"){
                location = "../html/admin.html";
                return true;
            } else if (data == "technik"){
                location = "../html/.html";
                return true;
            } else if (data == "error"){
                $("#loginform").trigger("reset");
                $("#error").text("Неверный логин или пароль");
                $("#dologin").prop("disabled", false);
                return false;
            } else if (data === "disabled"){
                $("#loginform").trigger("reset");
                $("#error").text("Эта учетная запись отключена");
                $("#dologin").prop("disabled", false);
                return false;
            }
        }
    });
});
/* $(document).ready(function() {
        console.log("load page");
        $('#loginform').on("click", function(e) {
            e.preventDefault();
            console.log('function');
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                datatype:"json",
                done:function(response) {
                    var jsonData = JSON.parse(response);
                    alert(3);
                /* if (data == '1'){
                        $("#error").text (data);
                    }
                    if (data == '1'){
                        $("#error").html (data);
                    }
                    if (jsonData.response == '-1'){
                        $("#error").text (response);
                    } else console.log("0");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });
    /*$(document).ready(function() {
        console.log("load page");
        $('#loginform').submit(function(e) {
            e.preventDefault();
            console.log('function');
            $.ajax({
                type: "POST",
                url: "../php/login1.php",
                data: $(this).serialize(),
                accesslevel:function(response) {
                    var jsonData = JSON.parse(response);
                    alert(3);
                /* if (data == '1'){
                        $("#error").text (data);
                    }
                    if (data == '1'){
                        $("#error").html (data);
                    }
                    if (jsonData.response == '-1'){
                        $("#error").text (response);
                    } else console.log("0");
                }
            });
        });
    });*/
    /*
    $("#dologin").bind("click", function(){
        $.ajax ({
            url: "php/login.php",
            type: "POST",
            data: ({login: $("#login").val(), pwd: $("#pwd").val()}),
            dataType: "html",
            error: function(data){
                if (data !== ""){
                    $("#error").text (data);
                }
            }
        });
    });*/