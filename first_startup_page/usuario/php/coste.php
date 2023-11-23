<?php
    function coste($followers){
        $calculo = $followers*0.00035;
        if ($followers<1000){
            $calculo = $calculo;
        }else if($followers>=1000 && $followers<3000){
            $calculo -= 0.1*$calculo;
        }else if($followers>=3000 && $followers<5000){
            $calculo -= 0.12*$calculo;
        }else if($followers>=5000 && $followers<10000){
            $calculo -= 0.13*$calculo;
        }else if($followers>=10000 && $followers<20000){
            $calculo -= 0.14*$calculo;
        }else if($followers>=20000 && $followers<30000){
            $calculo -= 0.15*$calculo;
        }else if($followers>=30000 && $followers<40000){
            $calculo -= 0.16*$calculo;
        }else if($followers>=40000){
            $calculo = 20;
        }
        $calculo = ((int) ($calculo * 1000))/1000;
        return $calculo;
    }
?>