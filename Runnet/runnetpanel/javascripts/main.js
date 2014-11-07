/**
 * Created by Hamza on 2014-11-04.
 */

$(document).ready(function(){



    function _ajax(aType, aUrl, aData, aCache, aSuccess)
    {
        $.ajax({
            type: aType,
            data: aData,
            cache: aCache,
            url: aUrl,
            success: aSuccess
        });
    }


    function login(){

        $("#loginButton").click(function(){

            var username = $("#runnetdbUser").val();
            var password = $("#runnetdbPass").val();

            var data = "runnetdbUser=" + username + "&runnetdbPass=" + password;

            _ajax("POST", "loginscript.php", data, false, function(result){
                $("#showLogin").html(result).fadeIn(700).delay(3000).fadeOut(700);

                if($("#showLogin").html() == "Success!"){
                    window.location = "dashboard.php";
                }


                $("#runnetdbPass").val("");

            });


        });


    }
    login();

});