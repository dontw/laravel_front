<?php
    $csrf = App\Utility\CsrfHelper::GetCsrfToken();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta id="csrfToken" name="csrf-token" content="{{ $csrf }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    </head>
    <body>
        <?php
            if($csrf != '')
            {
                echo '<h1>WELCOME</h1>
                user name:<input type="text" id="userName" /><br/>
                <input type="button" onclick="GetUser()" value="find user"/>
                <div id="userInfo"></div>';
            }
            else
            {
                echo '<h1>Laravel User Login</h1>        
                login id:<input type="text" id="userId" /><br/>
                password:<input type="password" id="pwd" /><br/>
                <input type="button" onclick="DummyPost()" value="login"/>';
            }
        ?>
                
    </body>
</html>
<script>
    
    function loginClk(){
        var url = "/api/login/";
        var parameters = document.getElementById("userId").value + "/" + document.getElementById("pwd").value;;
        fetch(url + parameters)
        .then(function(response) {
            return response.json();
        }).then(function(jsonObj) {
            console.log(jsonObj);
            //alert(jsonObj.model);
            setCookie("AUTH-TOKEN",jsonObj.model.token,30);
            location.reload();
        }).catch(function(err) {
            // Error :(
        });
    }
    
    function DummyPost(){
        var config = {
            method: 'POST',
            headers: new Headers({
                'Content-Type': 'text/json',
                'X-CSRF-TOKEN': document.getElementById("csrfToken").content
            })
        }
        fetch('/api/dummy',config)
        .then(function(response) {
            return response.json();
        }).then(function(jsonObj) {
            console.log(jsonObj);
            window.location.href = '/info';
            //alert(jsonObj.status);
        }).catch(function(err) {
            // Error :(
        });
    }

    function GetUser(){
        var username = document.getElementById("userName").value;
        var config = {
            method: 'GET',
            headers: new Headers({
                'Content-Type': 'text/json',
                'X-CSRF-TOKEN': document.getElementById("csrfToken").content,
                'AUTH-TOKEN': getCookie('AUTH-TOKEN')
            })
        }
        fetch('/api/users/' + username,config)
        .then(function(response) {
            return response.json();
        }).then(function(jsonObj) {
            console.log(jsonObj);
            document.getElementById("userInfo").innerText = JSON.stringify(jsonObj.model);
            //alert(jsonObj.model);
        }).catch(function(err) {
            // Error :(
        });
    }

    function setCookie(cname, cvalue, exmins) {
        var d = new Date();
        d.setTime(d.getTime() + (exmins*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
</script>