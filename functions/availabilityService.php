<?php

require_once 'jsonParser.php';



$resultString = getRTAC();
                
    //wenn resultString gültig:                
    if (isset($resultString)) {
        
        //var_dump($resultString);
        $result = parseRTAC($resultString);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        //var_dump($result);
        return;
        

        } else {
            echo '$resultString empty';

        }
        
        


   