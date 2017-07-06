<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta id="csrfToken" name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    </head>
    <body>
        <h1>Laravel User Login</h1>
        <h1>{{ csrf_token() }}</h1>
        login id:<input type="text" id="userId" /><br/>
        password:<input type="password" id="pwd" /><br/>
        <input type="button" onclick="loginClk()" value="login"/>
        <form method="POST" action="/api/dummy">
            <input type="submit" value="TEST CSRF"/>
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        </form>
    </body>
</html>
<script>
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    // function AjaxDummyPost(){
    //     $.post('/api/dummy');
    // }

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
            alert(jsonObj.token);
        }).catch(function(err) {
            // Error :(
        });
    }
</script>