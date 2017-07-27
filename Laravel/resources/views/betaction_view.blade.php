<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">      
        <meta id="csrfToken" name="csrf-token" content="{{ $csrf }}">  
        <title>Bet Action</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="/js/util.js"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    </head>
    <body>
        <h1>user bet action</h1>
        Cash-balance:<div id="cashB">{{$cash}}</div></br>
        Chip-balance:<div id="chipB">{{$chip}}</div></br>
        </br>
        輸入範例：</br>
        01+02+03+04+05+06</br>
        <input id="seletNum" type="text" placeholder="輸入下注號碼"/><input type="button" onclick="Bet()" value="下注"/></br>
                
        <a href="/menu">back</a>
        
    </body>
</html>
<script>
    function Bet(){
        var numbers = document.getElementById("seletNum").value;
        var reg = /^([0-9]{2,2}\+){5,48}[0-9]{2,2}$/i;
        if(!reg.test(numbers)){
            alert("invalid input");
            document.getElementById("seletNum").value = "";
            return;
        }
        var config = {
            method: 'POST',
            headers: new Headers({
                'Content-Type': 'text/json',
                'X-CSRF-TOKEN': document.getElementById("csrfToken").content,
                'AUTH-TOKEN': getCookie('AUTH-TOKEN')
            }),
            body:numbers
        }
        
        fetch('/api/bet',config)
        .then(function(response) {
            return response.json();
        }).then(function(jsonObj) {
            console.log(jsonObj);
            if(jsonObj.model){
                document.getElementById("cashB").textContent = jsonObj.model.cashBalance;
                document.getElementById("chipB").textContent = jsonObj.model.chipBalance;
            }            
            alert(jsonObj.message);            
        }).catch(function(err) {
            // Error :(
        });
    }    
</script>