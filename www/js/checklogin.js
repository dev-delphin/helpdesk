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
            if (data == "login"){
                location = "../html/tasks.html";
                return true;
            } else if (data == "error"){
                $("#loginform").trigger("reset");
                $("#error").text("Неверный логин или пароль");
                $("#dologin").prop("disabled", false);
                return false;
            }
        }
    });
});