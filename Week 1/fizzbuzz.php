<?php

function fizzBuzz($num){
    if ($num % 2 == 0 && $num % 3 == 0){
        return "fizz buzz";
    } elseif ($num % 2 == 0){
        return "fizz";
    } elseif ($num % 3 == 0){
        return "buzz";
    } else{
        return $num;
    }
}
for ($i = 1; $i <= 100; $i++){
    echo fizzBuzz($i);
}
?>