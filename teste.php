<?php 


	$string = 'aaaaaAa1a#';
    $RegEx = preg_match("([+0-9][+a-zA-Z][+\W])", $string);

    if($RegEx){
   echo 'Aceito https://www.phpliveregex.com/ !';
    }else{
       echo 'NAO!';

    }

