<?php
/**
 * Get JSON data from Aleph RTAC service and return result as string
 * $docnr is the record id in the Aleph database for the "Kleinmaterialien" title record which contains the gadgets.
 * $format can be JSON or XML. This service is written for JSON only.
 * @return JSON string
 */

function getRTAC () {
    
    //Realtime-Service:
    //For testing, comment out line $file = "http://aleph.unisg.ch..."
    
    $format = 'json';
    $docnr = '000488936';
    $file = "http://aleph.unisg.ch/cgi-bin/getRTAC_Info.pl?docnr=" . $docnr . "&lng=fre&format=" . $format;
    
    //Test files: uncomment the desired test file:
    //Simulate status as of 21 March 2018
    //$file = "data/test_21032018.json";
    //Simulate status as of  as of 4 April 2018
    //$file = "data/test_04042018.json";
    //Simulate status as of 13 April 2018
    //$file = "data/test_13042018.json";
    //Simulate status as of 16 April 2018
    //$file = "data/test_16042018.json";
    $jsonstring = file_get_contents($file); 
    return $jsonstring;       

}

/**
 * Decode the passed JSON string ($data) and group the gadgets by type.
 * $list is an array to store the parsed gadgets by their group id (key), which is a unique integer for each 
 * gadget type. For each key, the values callno (call number), volume (a character id for each gadget), 
 * note (a detailed description), total amount for each gadget and number of currently available items is stored.
 * The filename for the image to be shown is created with the volume characters. 
 * @param type $data (JSON string from RTAC service)
 * @return int
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
               
               if (array_key_exists($id, $list)) { //entry already exists in $list                

                    $list[$id]['total'] += 1;
                   
               } else { //new entry in $list                  

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
