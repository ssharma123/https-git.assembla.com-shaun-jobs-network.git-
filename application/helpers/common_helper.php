<?php


if(!function_exists('formate_date')) {
    function formate_date($datetime,$formate = ""){
        $default_formate = ($formate == "") ? "F j, Y, g:i a" : $formate;
        $formated_datetime = date($default_formate,$datetime);
        return $formated_datetime;
    }
}

/**************************************************************/

