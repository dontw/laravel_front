<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <title>Bet Result</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.11/semantic.min.css">
        <link rel="stylesheet" href="css/don.css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    </head>
    <body>
        <div class="ui divider hidden"></div>
        <div class="ui huge header center aligned">Bet Result</div>
        <div class="ui divider"></div>
        <?php
            //設定時間物件
            $date = new DateTime();

            //接收撈取的資料到model
            $obj = json_decode($infos, true);
            $model = $obj['model'];
        ?>      
        <div class="ui container">
            <table class="ui large celled table">
                <thead>
                    <tr>
                    <th>編號</th>
                    <th>下注時間</th>
                    <th>下注號碼</th>
                    <th>注數</th>
                    <th>下注金額</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php 
                        $redNumber = ["01", "02", "07", "08", "12", "13", "18", "19", "23", "24", "29", "30", "34", "35", "40", "45", "46"];
                        $blueNumber =  ["03", "04", "09", "10", "14", "15", "20", "25", "26", "31", "36", "37", "41", "42", "47", "48"];
                        $greenNumber =  ["05", "06", "11", "16", "17", "21", "22", "27", "28", "32", "33", "38", "39", "43", "44", "49"];
                        foreach($model as $key=>$value): 
                    ?>
                    <tr>
                    <td><?= $key + 1 ?></td>
                    <td>
                        <?php 
                            $date->setTimestamp(intval($value['actionTime']/1000));
                            echo $date->format('Y-m-d H:i:s'); 
                        ?>
                    </td>
                    <td style="text-align:left; width:60%;">
                        <?php 
                             $betNum = explode("+",$value['selectedNumbers']);
                             foreach($betNum as $num){
                                if(in_array($num, $redNumber)){
                                     echo '<div class="betInfoNurmColor redBg">'. $num .'</div>';
                                }

                                if(in_array($num, $blueNumber)){
                                     echo '<div class="betInfoNurmColor blueBg">'. $num .'</div>';
                                }

                                if(in_array($num, $greenNumber)){
                                     echo '<div class="betInfoNurmColor greenBg">'. $num .'</div>';
                                }
                               
                             }
                        ?>
                    </td>
                    <td><?= $value['totalBet'] ?></td>
                    <td><?= $value['totalAmount'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> 

        <a href="/menu">back</a>
    </body>
</html>