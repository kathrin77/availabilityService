<?php

require_once 'jsonParser.php';

/**
 * The Availability Service gets the JSON string from the RTAC service and groups it
 * by different gadgets (Method parseRTAC). The returned array is encoded back to JSON and returned.
 */

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
        
        


   