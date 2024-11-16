<?php

/*Function to check if a request method is POST*/

function isPostRequest(){
    return( filter_input(INPUT_SERVER, 'REQUEST_METHOD')=== 'POST');
}

/*Function to check if a request method is POST*/
function isGetRequest() {
    return (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' && !empty($_GET));
}
