<?php


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
    $jsonstring = file_get_contents($file); //gibt Resultat als String zurück
    return $jsonstring;       

}


function parseRTAC($data) {
        $jsondecode = json_decode($data); //decodiert einen json-string
        
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
               //$callno = rtrim($callno, "Nr. 1234567890");
               $note = $jsondecode->items[$i]->note;
               $available = $jsondecode->items[$i]->available;
               $img_id = $volume.'.png';               
               
               if (array_key_exists($id, $list)) { //bestehender Eintrag                 

                    $list[$id]['total'] += 1;
                   
               } else { //neuer Eintrag                   

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
            
            //$jsonlist = json_encode($list, JSON_UNESCAPED_UNICODE);
            unset($list['id']);
            return $list;            

        } else {

            return $jsondecode->success;
        }                
    }