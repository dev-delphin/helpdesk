$(document).ready(function(){
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
                location = "../html/superadminpage.html";
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