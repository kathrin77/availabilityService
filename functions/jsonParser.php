<?php

/**
 * Gets data from RTAC service and returns them as string. Data format is JSON.
 * The document nr for the "Kleinmaterialien"-record in Aleph is 000488936.
 * 
 * @return JSON String
 */
function getRTAC () {
    
    //Realtime-Service:
    
    $format = 'json';
    $docnr = '000488936';
    $file = "http://aleph.unisg.ch/cgi-bin/getRTAC_Info.pl?docnr=" . $docnr . "&lng=fre&format=" . $format;
    
    //Test-Dateien:
    //Stand vom 21. März 2018
    //$file = "data/test_21032018.json";
    //Stand vom 4. April 2018
    //$file = "data/test_04042018.json";
    //Stand vom 13. April 2018
    //$file = "data/test_13042018.json";
    $jsonstring = file_get_contents($file); 
    return $jsonstring;       

}

/**
 * Parses the data by decoding the json string. 
 * If successful, the data is looped through and added to hashmap $list with a temporary first entry "id".
 * The array key is the groupid (a number for each gadget group).
 * For each key, the call number (trimmed), volume (= unique character for each gadget group), note and availability is added.
 * The total is a counter for each key, whereas the availability only counts those gadgets who are currently available.
 * At the end, the temporary entry "id" is removed.
 * The array now contains the grouped gadgets and is returned.
 * 
 * @param type $data (JSON string)
 * @return array $list
 */


function parseRTAC($data) {
        $jsondecode = json_decode($data); 
        
        if ($jsondecode->success) {
            
            $itemtotal = $jsondecode->itemtotal;            
            $cluster = array('callno'=>'', 'img_id'=>'', 'total'=>0, 'available'=>0, 'note'=>'', 'volume'=> '');            
            $list = array('id'=>$cluster);                 
            //var_dump($list);
            
            for ($i = 0; $i< $itemtotal; $i++) {
                
               $id = $jsondecode->items[$i]->groupid;             
               $volume = $jsondecode->items[$i]->volume;
               $callno = $jsondecode->items[$i]->callno;
               $callno = substr($callno, 1, -2);
               $note = $jsondecode->items[$i]->note;
               $available = $jsondecode->items[$i]->available;
               $img_id = $volume.'.png';               
               
               if (array_key_exists($id, $list)) { //gadget already in array                 

                    $list[$id]['total'] += 1;
                   
               } else { //new gadget to save in array                   

                    $list[$id] = $cluster;
                    $list[$id]['total'] = 1;
                    $list[$id]['callno'] = $callno;
                    $list[$id]['img_id'] = $img_id;
                    $list[$id]['note'] = $note;
                    $list[$id]['volume'] = $volume;
               }
               
               if ($available) {
                   $list[$id]['available'] +=1;
               }                
            } 
            
            unset($list['id']);
            return $list;            

        } else {

            return $jsondecode->success;
        }                
    }
