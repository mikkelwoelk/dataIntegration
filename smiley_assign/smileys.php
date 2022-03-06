<?php
    // Check if file exists
    if (file_exists('allekontrolresultater.xml')) {
        
        // load file with simplexml_load_file
        $xml = simplexml_load_file('allekontrolresultater.xml');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"  href="smileys.css">
  <title>Smileys</title>
</head>
<body>
  <main>
    <?php 
    readNode($xml);
    function readNode($xml) {
        $att = $xml->attributes();
        $postnr_arr = array(6000, 7000, 7100, 7120, 7130, 7140, 7190);
        $oldDate = strtotime($att->seneste_kontrol_dato);
        $newDate = date('d-m-Y', $oldDate);
        $newDateTime = date('H:i:s', $oldDate);
        if(in_array($att->postnr, $postnr_arr) && ($att->brancheKode == "56.30.00")){
          echo '<div class="shop-tile">';
            echo '<h2 class="shop-name">'.$att->navn1.'</h2>';
            echo '<p class="shop-address">'.$att->adresse1.'</p>';
            echo '<p class="shop-zip">'.$att->postnr.', '.$att->By.'</p>';
            echo '<h3 class="shop-control-header">Latest Control Stats</h3>';
            echo '<div class="shop-control-stats-container">';
            echo '<div class="shop-control-stats">';
            if($att->seneste_kontrol_dato && $att->seneste_kontrol){
                echo '<p class="shop-control-date">Date: <br/>'.$newDate.' kl: '.$newDateTime.'</p>';
                echo '<p class="shop-control-dateTime">Rating: <br/>'.$att->seneste_kontrol.'</p>';
              } else {
                echo '<p class="shop-control-date">Date: <br/>No record.</p>';
                echo '<p class="shop-control-dateTime">Rating: <br/>No record.</p>';
              }
              echo '</div>';
              echo '</div>';
            echo '<a class="shop-website" href="'.$att->URL.'">More info</a>';
          echo '</div>';
        }
        
        // Check for children
        foreach ($xml->children() as $node) {
            // If element has children, traverse
            readNode($node);
        }
    } ?>
  </main>
</body>
</html>