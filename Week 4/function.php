<?php

/*function to check if a post was */

function isPostRequest(){
    return( filter_input(INPUT_SERVER, 'REQUEST_METHOD')=== 'POST');
}