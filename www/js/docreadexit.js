$(document).ready(function() {
    $.get("../php/checkauthtask.php", function(data){
        if (data == "nook"){
            location = "../index.html";
            return true;
        } else { $("#usernamesettings").text(data); }
    });
 });
$("#exit").on("click", function(){
    $.ajax({
        url: "../php/exit.php",
        type: "POST",
        cache: false,
        data: {},
        dataType: "html",
        beforeSend: function(){
            $("#exit").prop("disabled", true);
        },
        success: function(data){
            if (data == "ok"){
                location = "../index.html";
                return true;
            }
        }
    });
});