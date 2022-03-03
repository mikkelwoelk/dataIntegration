<?php

    // Check if file exists
    if (file_exists('allekontrolresultater.xml')) {
        
        // load file with simplexml_load_file
        $xml = simplexml_load_file('allekontrolresultater.xml');
    }

    // Execute recursive function
    readNode($xml);
    
    // read first node
    function readNode($xml) {

        $att = $xml->attributes();
        $postnr_arr = array(6000, 7000, 7100, 7120, 7130, 7140, 7190);
        if(in_array($att->postnr, $postnr_arr) && ($att->brancheKode == "56.30.00")){
          echo '<div>';
          echo 'Butiksnavn: '.$att->navn1;
          echo '<br/>';
          echo 'PostNo: '.$att->postnr;
          echo '<br/>';
          echo 'Bynavn: '.$att->By;
          echo '<br/>';
          if($att->seneste_kontrol_dato && $att->seneste_kontrol){
            echo 'Seneste kontrol dato: '.$att->seneste_kontrol_dato;
            echo '<br/>';
            echo 'Seneste kontrol rating: '.$att->seneste_kontrol;
          } else {
            echo 'Denne butik har ingen seneste kontrol dato';
            echo '<br/>';
            echo 'Denne butik har ingen kontrol rating';
          }
          echo '</div>';
          echo '<br/>';
        }
        
        // Check for children
        foreach ($xml->children() as $node) {
            // If element has children, traverse
            readNode($node);
        }
    }
?>

<table>
  
</table>