<?php

/*Function to check if a request method is POST*/

function isPostRequest(){
    return( filter_input(INPUT_SERVER, 'REQUEST_METHOD')=== 'POST');
}