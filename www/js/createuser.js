$("#savesettings").on("click", function(){
    var login = $("#login").val();
    var password = $("#pwd").val();
    var email= $("#email").val();
    var privelege = $("#privelege").val();

    const beginWithoutDigit = /^\D.*$/
    const withoutSpecialChars = /^[^-() /]*$/
    const containsLetters = /^.*[a-zA-Z]+.*$/

    if(login == ""){
        $("#error").text("Поле логина пустое");
        return false;
    } else if(password == ""){
        $("#error").text("Поле пароля пустое");
        return false;
    } else if(email == ""){
        $("#error").text("Поле почты пустое");
        return false;
    } else if(privelege == ""){
        $("#error").text("Поле привелегии пустое");
        return false;
    }
    
    if( beginWithoutDigit.test(password) &&
    withoutSpecialChars.test(password) &&
    containsLetters.test(password) ){
        console.log('ok');
    } else {
        $("#error").text("В пароле использованы некоректные символы");
    }

    $.ajax({
        url: "../php/createuser.php",
        type: "POST",
        cache: false,
        data: {"login": login, "password": password, "email": email, "privelege": privelege},
        dataType: "html",
        beforeSend: function(){
            $("#savesettings").prop("disabled", true);
        },
        success: function(data){
            $("#error").text("Настройки пользователя сохранены");
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