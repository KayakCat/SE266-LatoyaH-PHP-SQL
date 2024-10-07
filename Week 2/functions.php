<?php

function calcPoints($wins, $otLosses){
    
    $points = ($wins *2) + $otLosses;

    return $points;
}
