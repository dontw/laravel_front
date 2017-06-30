<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>Laravel User Login</h1>

        login id:<input type="text" id="userId" /><br/>
        password:<input type="password" id="pwd" /><br/>
        <input type="button" onclick="loginClk()" value="login"/>
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
            alert(jsonObj.token);
        }).catch(function(err) {
            // Error :(
        });
    }
</script>