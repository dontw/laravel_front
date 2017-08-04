<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">      
        <meta id="csrfToken" name="csrf-token" content="{{ $csrf }}">  
        <title>Bet Action</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="/js/app.js"></script>
        <script src="/js/util.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.11/semantic.min.css">
        <link rel="stylesheet" href="css/don.css">
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    </head>
    <body>
        <?php 
        function money_format($format, $number) 
        { 
            $regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'. 
                    '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/'; 
            if (setlocale(LC_MONETARY, 0) == 'C') { 
                setlocale(LC_MONETARY, ''); 
            } 
            $locale = localeconv(); 
            preg_match_all($regex, $format, $matches, PREG_SET_ORDER); 
            foreach ($matches as $fmatch) { 
                $value = floatval($number); 
                $flags = array( 
                    'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ? 
                                $match[1] : ' ', 
                    'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0, 
                    'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ? 
                                $match[0] : '+', 
                    'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0, 
                    'isleft'    => preg_match('/\-/', $fmatch[1]) > 0 
                ); 
                $width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0; 
                $left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0; 
                $right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits']; 
                $conversion = $fmatch[5]; 

                $positive = true; 
                if ($value < 0) { 
                    $positive = false; 
                    $value  *= -1; 
                } 
                $letter = $positive ? 'p' : 'n'; 

                $prefix = $suffix = $cprefix = $csuffix = $signal = ''; 

                $signal = $positive ? $locale['positive_sign'] : $locale['negative_sign']; 
                switch (true) { 
                    case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+': 
                        $prefix = $signal; 
                        break; 
                    case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+': 
                        $suffix = $signal; 
                        break; 
                    case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+': 
                        $cprefix = $signal; 
                        break; 
                    case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+': 
                        $csuffix = $signal; 
                        break; 
                    case $flags['usesignal'] == '(': 
                    case $locale["{$letter}_sign_posn"] == 0: 
                        $prefix = '('; 
                        $suffix = ')'; 
                        break; 
                } 
                if (!$flags['nosimbol']) { 
                    $currency = $cprefix . 
                                ($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) . 
                                $csuffix; 
                } else { 
                    $currency = ''; 
                } 
                $space  = $locale["{$letter}_sep_by_space"] ? ' ' : ''; 

                $value = number_format($value, $right, $locale['mon_decimal_point'], 
                        $flags['nogroup'] ? '' : $locale['mon_thousands_sep']); 
                $value = @explode($locale['mon_decimal_point'], $value); 

                $n = strlen($prefix) + strlen($currency) + strlen($value[0]); 
                if ($left > 0 && $left > $n) { 
                    $value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0]; 
                } 
                $value = implode($locale['mon_decimal_point'], $value); 
                if ($locale["{$letter}_cs_precedes"]) { 
                    $value = $prefix . $currency . $space . $value . $suffix; 
                } else { 
                    $value = $prefix . $value . $space . $currency . $suffix; 
                } 
                if ($width > 0) { 
                    $value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ? 
                            STR_PAD_RIGHT : STR_PAD_LEFT); 
                } 

                $format = str_replace($fmatch[0], $value, $format); 
            } 
            return $format; 
        } 
        
        ?>
        <div class="ui divider hidden"></div>
        <div class="ui huge header center aligned">User Bet Action</div>
        <div class="ui divider"></div>

        <div class="ui container">
            <div class="ui two column grid">
                <div class="column">
                    <div class="ui green segment">
                        <div class="ui header center aligned">目前現金餘額</div>
                        <div class="ui divider"></div>
                        <div class="betAction_cash">
                            <?= money_format("%n", $cash) ?>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui yellow segment">
                        <div class="ui header center aligned">目前籌碼餘額</div>
                        <div class="ui divider"></div>
                        <div class="betAction_cash">
                            <?= money_format("%n", $chip) ?>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui segment">
                        <div class="ui header left aligned">選取投注號碼（選取六碼）</div>
                        <div class="ui divider"></div>
                        <div class="betNumPanel">
                            <?php
                                $betNum = [];
                                for($i = 1 ; $i <=49; $i ++ ){
                                    if($i<10){$i = '0'.$i;}
                                    array_push($betNum, $i);
                                }
                                foreach($betNum as $num){
                                    echo '<div class="betInfoNum betInfoNum--Big betNum">'. $num .'</div>';
                                } 
                            ?>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui segment">
                        <div class="ui header left aligned">目前選取號碼</div>
                        <div class="ui divider"></div>
                        <div class="betNumPanel" id="selectedNum">
                            {{--  <div class="betInfoNum betInfoNum--Big betInfoNum--Big--selected">01</div>  --}}
                        </div>
                    </div>
                </div>
                <div class="column"></div>
                <div class="column">
                    <button class="ui right floated primary huge button" onclick="Bet()">
                        下注
                    </button>
                </div>
                
            </div>
        </div>
        <a href="/menu">back</a>
        
    </body>
</html>
<script>
    var betNums = document.querySelectorAll(".betnum");
    var selectedBetNums = [];

    //設定事件聆聽到每個號碼按鈕
    betNums.forEach(function(betNum){
        betNum.addEventListener("click",selectBetNum);
    });


    //從panel選取號碼 
    //改變按鈕顏色 
    //增加或刪除陣列中的號碼 
    //增加或刪除顯示中的號碼
    function selectBetNum(){

        //add or remove grey class
        this.classList.toggle("betInfoNum--Big--grey");
        let betNumIndex = selectedBetNums.indexOf(this.innerHTML);
        let betNumVal = this.innerHTML;

        //如果陣列沒有這個數字(index = -1)，把數字塞進陣列
        if( betNumIndex === -1 ){
            selectedBetNums.push(betNumVal);
            divAddSelect(betNumVal);
        }else{
            selectedBetNums.splice(betNumIndex, 1);
            $('.betInfoNum--Big--selected:contains('+ betNumVal +')').remove();
        }
    }

    //增加按鈕圖示到顯示區
    function divAddSelect(betNumVal){
        let numEle = document.createElement("div");
        let numClass = ['betInfoNum', 'betInfoNum--Big', 'betInfoNum--Big--selected'];

        numEle.innerText = betNumVal;
        numEle.classList.add(...numClass);
        numEle.addEventListener("click", delFromSelect);
        document.querySelector("#selectedNum").appendChild(numEle);
    }


    //由顯示區點擊按鈕
    //刪除陣列中的值
    //並把按鈕盤中的按鈕灰色變回來
    function delFromSelect(){
        let betNumVal = this.innerHTML;
        let betNumIndex = selectedBetNums.indexOf(this.innerHTML);

        //刪掉存在陣列的這個值
        if( betNumIndex > -1 ){
             selectedBetNums.splice(betNumIndex, 1);
             console.log(selectedBetNums);
             //刪除有對應值得灰按鈕
             $('.betInfoNum--Big--grey:contains('+ betNumVal +')').removeClass('betInfoNum--Big--grey');
             //自爆
             $(this).remove();
        }
         
    }



    function Bet(){
        if(selectedBetNums.length < 6){
            alert("請選六組以上號碼!");
            return false;
        }
        var numbers = selectedBetNums.join("+");
        console.log(numbers);



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