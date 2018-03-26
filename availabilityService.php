<?php

require_once 'Metadata.php';
require_once 'jsonParser.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$docnr = '488936';

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
        
        


   