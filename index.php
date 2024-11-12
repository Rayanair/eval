<?php
function eval_expr(string $expr){

    preg_match('/\(([^)(]+)\)/', $expr, $matches, PREG_OFFSET_CAPTURE);
    
    if(isset($matches[1][0])){
        $op = $matches[1][0];
        $bvNumber = []; 
        $balOpe = [];
        $salOpe2 = [];

        $keywords = preg_split("/[\s+-\/*%]+/", $op);

        for ($i=0; $i < strlen($op); $i++) { 
            if($op[$i] == "*" || $op[$i] == "/" || $op[$i] == "%" || $op[$i] == "+" || $op[$i] == "-"){
                array_push($balOpe, $op[$i]);
            }
        }

        $r = 0;

        foreach ($keywords as $key => $value) {
            if(isset($balOpe[$r]) && $balOpe[$r] == "/" || $balOpe[$r] == "*" || $balOpe[$r] == "%"){
                array_push($bvNumber, $value);
                array_push($bvNumber, $balOpe[$r]);
            }else{
                array_push($bvNumber, $value);
            }
            $r++;
        }

        for ($i=0; $i < count($balOpe); $i++) { 
            if($balOpe[$i] == "+" || $balOpe[$i] == "-"){
                array_push($salOpe2, $balOpe[$i]);
            }
        }

        
        $cramptou = [];
        for ($i=0; $i < count($bvNumber); $i++) { 
            if(isset($bvNumber[$i+1]) && $bvNumber[$i+1] == "/" || $bvNumber[$i+1] == "%" || $bvNumber[$i+1] == "*"){
                switch($bvNumber[$i+1]) {
                case '/': 
                    $elop = intval($bvNumber[$i]) / intval($bvNumber[$i+2]);
                    array_push($cramptou, $elop);
                    break;
                case '*': 
                    $elop = intval($bvNumber[$i]) * intval($bvNumber[$i+2]);
                    array_push($cramptou , $elop);
                    break;
                case '%': 
                    $elop = intval($bvNumber[$i]) % intval($bvNumber[$i+2]);
                    array_push($cramptou , $elop);
                    break;
            }
            }elseif(isset($bvNumber[$i-1]) && $bvNumber[$i-1] == "/" || $bvNumber[$i-1] == "%" || $bvNumber[$i-1] == "*"){
                echo $bvNumber[$i]." haha crampté";
            }elseif($bvNumber[$i] == "/" || $bvNumber[$i] == "*" || $bvNumber[$i] == "%" ){
                echo $bvNumber[$i]." haha crampté";
            }else{
                array_push($cramptou , intval($bvNumber[$i]));
            }
        }

        $t = count($salOpe2);
         for ($i=0; $i < $t; $i++) { 
            $last = array_shift($cramptou);
            $firts = array_shift($cramptou);
            $oprato = array_shift($salOpe2);
            switch($oprato) {
                case '+': 
                    $elop = $firts + $last;
                    array_push($cramptou, $elop);
                    break;
                case '-': 
                    $elop = $firts - $last;
                    array_push($cramptou, $elop);
                    break;
            }
            
        }
            
                $rrr = str_replace($matches[0][0],$cramptou[0], $expr);
                eval_expr($rrr);

    }else{
        $bvNumber = []; 
        $balOpe = [];
        $salOpe2 = [];

        $keywords = preg_split("/[\s+-\/*%]+/", $expr);

        for ($i=0; $i < strlen($expr); $i++) { 
            if($expr[$i] == "*" || $expr[$i] == "/" || $expr[$i] == "%" || $expr[$i] == "+" || $expr[$i] == "-"){
                array_push($balOpe, $expr[$i]);
            }
        }

        $r = 0;

        foreach ($keywords as $key => $value) {
            if(isset($balOpe[$r]) && $balOpe[$r] == "/" || $balOpe[$r] == "*" || $balOpe[$r] == "%"){
                array_push($bvNumber, $value);
                array_push($bvNumber, $balOpe[$r]);
            }else{
                array_push($bvNumber, $value);
            }
            $r++;
        }

        for ($i=0; $i < count($balOpe); $i++) { 
            if($balOpe[$i] == "+" || $balOpe[$i] == "-"){
                array_push($salOpe2, $balOpe[$i]);
            }
        }

        
        $cramptou = [];
        for ($i=0; $i < count($bvNumber); $i++) { 
            if(isset($bvNumber[$i+1]) && $bvNumber[$i+1] == "/" || $bvNumber[$i+1] == "%" || $bvNumber[$i+1] == "*"){
                switch($bvNumber[$i+1]) {
                case '/': 
                    $elop = intval($bvNumber[$i]) / intval($bvNumber[$i+2]);
                    array_push($cramptou, $elop);
                    break;
                case '*': 
                    $elop = intval($bvNumber[$i]) * intval($bvNumber[$i+2]);
                    array_push($cramptou , $elop);
                    break;
                case '%': 
                    $elop = intval($bvNumber[$i]) % intval($bvNumber[$i+2]);
                    array_push($cramptou , $elop);
                    break;
            }
            }elseif(isset($bvNumber[$i-1]) && $bvNumber[$i-1] == "/" || $bvNumber[$i-1] == "%" || $bvNumber[$i-1] == "*"){
                echo $bvNumber[$i]." haha crampté";
            }elseif($bvNumber[$i] == "/" || $bvNumber[$i] == "*" || $bvNumber[$i] == "%" ){
                echo $bvNumber[$i]." haha crampté";
            }else{
                array_push($cramptou , intval($bvNumber[$i]));
            }
        }

        $t = count($salOpe2);
         for ($i=0; $i < $t; $i++) { 
            $last = array_shift($cramptou);
            $firts = array_shift($cramptou);
            $oprato = array_shift($salOpe2);
            switch($oprato) {
                case '+': 
                    $elop = $firts + $last;
                    array_push($cramptou, $elop);
                    break;
                case '-': 
                    $elop = $firts - $last;
                    array_push($cramptou, $elop);
                    break;
            }
            
        }

        return $cramptou[0];
    }
    
}

 eval_expr($argv[1]);