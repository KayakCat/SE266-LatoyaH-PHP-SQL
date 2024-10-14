<?php
//function to calculate age based on birthdate entered
function age ($bdate) {
    $date = new DateTime($bdate);
    $now = new DateTime();
    $interval = $now->diff($date);
    return $interval->y;
 }
 //function to check the birthdate 
 function isDate($dt) {
    $date_arr  = explode('-', $dt);
    return checkdate($date_arr[1], $date_arr[2], $date_arr[0]);
 }
 //function to determine bmi category
 function bmiDescription($bmi) {
    if ($bmi < 18.5) {
        return 'Underweight';
    } elseif ($bmi >= 18.5 && $bmi < 24.9) {
        return 'Normal weight';
    } elseif ($bmi >= 25.0 && $bmi < 29.9) {
        return 'Overweight';
    } else {
        return 'Obese';
    }
 }

// calculate BMI based on height in feet and inches and weight in pounds
function bmi($ft, $inches, $weight) {
    // convert height to total inches to be able to calculate bmi
    $height_in_inches = ($ft * 12) + $inches;
    
    // bmi calculation
    return ($weight / ($height_in_inches * $height_in_inches)) * 703;
}
