<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <title>Bet Result</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    </head>
    <body>
        <h1>Bet Infos</h1>
        <?php
            $obj = json_decode($infos, true);
            $model = $obj['model'];
            echo json_encode($model);
        ?>        
    </body>
</html>