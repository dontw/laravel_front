<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">      
        <meta id="csrfToken" name="csrf-token" content="{{ $csrf }}">  
        <title>Rollback Action</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="/js/util.js"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    </head>
    <body>
        <h1>rollback action</h1>
        
        <input id="draw_n" type="text" placeholder="輸入期數"/><input type="button" onclick="rollback()" value="送出"/></br>
                
        <a href="/menu">back</a>
        
    </body>
</html>
<script>
    function rollback(){
        var drawNumber = document.getElementById("draw_n").value;
        var config = {
            method: 'POST',
            headers: new Headers({
                'Content-Type': 'text/json',
                'X-CSRF-TOKEN': document.getElementById("csrfToken").content,
                'AUTH-TOKEN': getCookie('AUTH-TOKEN')
            }),
            body:drawNumber 
        }
        
        fetch('/api/rollback',config)
        .then(function(response) {
            return response.json();
        }).then(function(jsonObj) {
            console.log(jsonObj);
            alert(jsonObj.message);            
        }).catch(function(err) {
            // Error :(
        });
    }    
</script>