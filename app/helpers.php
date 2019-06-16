<?php

function dateView(){
    return 'd-m-Y';
}

function displayDate($date){
    return date(dateView(), strtotime($date));
}