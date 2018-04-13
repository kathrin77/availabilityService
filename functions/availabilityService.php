<?php

require_once 'jsonParser.php';

/**
 * The Availability Service gets the JSON string from Aleph RTAC service and 
 * groups the gadgets by type (method parseRTAC). 
 * The array returned by parseRTAC is encoded as JSON and returned, to be 
 * used by worker.js
 */

$resultString = getRTAC();
                                
    if (isset($resultString)) {
        
        //var_dump($resultString);
        $result = parseRTAC($resultString);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        //var_dump($result);
        return;
        

        } else {
            echo '$resultString empty';

        }
        
        


   