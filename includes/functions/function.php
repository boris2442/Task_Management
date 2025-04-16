<?php
function generateToken($length){
     $alphanum=array_merge(range(0, 9), range('a', 'z'), range('A', 'Z')); 
    $alphanumstring = implode('', $alphanum); 
    return substr(str_shuffle(str_repeat($alphanumstring, $length)), 0,  $length); 
}

