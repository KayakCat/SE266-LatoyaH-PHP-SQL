<?php

require 'functions2.php';
$age = 25;
if (checkAge($age)){
    echo 'You are not old enough';
}
else{
    echo 'Welcome, Wise One.';
}

require 'index2.view.php';