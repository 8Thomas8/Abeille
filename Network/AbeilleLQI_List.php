<!DOCTYPE html>

<html>
<body>

<?php
    
    /*
     (
     [0] => Array
     (
     [NeighbourTableEntries] => 0A
     [Index] => 00
     [ExtendedPanId] => 28d07615bb019209
     [IEEE_Address] => 00158d00019f9199
     [Depth] => 01
     [LinkQuality] => 75
     [BitmapOfAttributes] => 1a
     [NE] => 0000
     [NE_Name] => Ruche
     [Voisine] => df33
     [Voisine_Name] => Test: Temperature Rond Bureau
     [Type] => End Device
     [Relationship] => Child
     [Rx] => Rx-Off
     [LinkQualityDec] => 117
     )
     */
    
    if ( isset( $_GET['NE']) ) {
        $NE = $_GET['NE'];
    }
    else {
        $NE = "All";
    }
    
    if ( isset( $_GET['NE2']) ) {
        $NE2 = $_GET['NE2'];
    }
    else {
        $NE2 = "None";
    }
    
    if ( isset( $_GET['Cache']) ) {
        $Cache = $_GET['Cache'];
    }
    else {
        $Cache = "Cache";
    }
    
    if ( isset( $_GET['Data']) ) {
        $Data = $_GET['Data'];
    }
    else {
        $Data = "None";
    }
    
    require_once("NetworkDefinition.php");
    
    $DataFile = "AbeilleLQI_MapData.json";
    
    if ( $Cache == "Cache" ) {
        if ( file_exists($DataFile) ){
            
            $json = json_decode(file_get_contents($DataFile), true);
            // $LQI = $json->data;
            $LQI = $json['data'];
            // print_r( $LQI );
            // exit;
        }
        else {
            echo "Le cache n existe pas, faites un refresh.<br>";
        }
    }
    else {
        require_once("AbeilleLQI.php");
    }
    

    
    
    ?>

<!DOCTYPE html>
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
width: 100%;
}

td, th {
border: 1px solid #dddddd;
    text-align: left;
padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>
<?php
    echo "DEBUT: ".date(DATE_RFC2822)."<br>\n";
    echo "<table>\n";
    echo "<tr><th>NE</th><th>NE Name</th><th>Voisine</th><th>Voisine Name</th><th>Voisine IEEE</th><th>Relation</th><th>Profondeur</th><th>LQI</th></tr>\n";
    foreach ( $LQI as $key => $voisine ) {
        echo "<tr>";
        echo "<td>".$voisine['NE']."</td><td>".$voisine['NE_Name']."</td><td>".$voisine['Voisine']."</td><td>".$voisine['Voisine_Name']."</td><td>".$voisine['IEEE_Address']."</td><td>".$voisine['Relationship']."</td><td>".$voisine['Depth']."</td><td>".$voisine['LinkQualityDec']."</td>";
        echo "</tr>\n";
    }
    echo "</table>\n";
    echo "</body>\n";
    echo "</html>\n";
    
    // Formating pour la doc asciidoc
    if (0) {
        // echo "<table>\n";
        // echo "<tr><td>NE</td><td>Voisine</td><td>Relation</td><td>Profondeur</td><td>LQI</td></tr>\n";
        echo "|NE|Voisine|Relation|Profondeur|LQI\n";
        
        foreach ( $LQI as $key => $voisine ) {
            // echo "<tr>";
            // echo "<td>".$voisine['NE']."</td><td>".$voisine['Voisine']."</td><td>".$voisine['Relationship']."</td><td>".$voisine['Depth']."</td><td>".$voisine['LinkQualityDec']."</td>";
            
            echo "|".$voisine['NE']."|".$voisine['NE_Name']."|".$voisine['Voisine']."|"."|".$voisine['Voisine_Name']."|".$voisine['Relationship']."|".$voisine['Depth']."|".$voisine['LinkQualityDec']."\n";
            
            // echo "</tr>\n";
        }
        // echo "</table>\n";
    }
    
    // print_r( $NE_All );
    // print_r( $voisine );
    // print_r( $LQI );
    
    // deamonlog('debug', 'sortie du loop');
    echo "FIN: ".date(DATE_RFC2822)."<br>\n";
    ?>