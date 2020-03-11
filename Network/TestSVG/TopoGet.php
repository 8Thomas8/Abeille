<?php
    
    require_once dirname(__FILE__) . "/../../../../core/php/core.inc.php";
    
    $json = "[{ ";
    
    $eqLogics = eqLogic::byType('Abeille');
    foreach ($eqLogics as $eqLogic) {
        $logicalId = $eqLogic->getId();
        $name = $eqLogic->getName();
        //$shortAddress = str_replace("Abeille/", "", $eqLogic->getLogicalId());
        $id = $eqLogic->getLogicalId();
        // $shortAddress = ($name == 'Ruche') ? "0000" : $shortAddress;
        $X = max( 0, $eqLogic->getConfiguration('positionX'));
        $Y = max( 0, $eqLogic->getConfiguration('positionY'));
        
        $json = $json . '"' . $id.'": { "name": "'.$name.'", "positionX": '.$X.', "positionY": '.$Y.', "logicalId": "'.$logicalId.'" }, ';
    }
    
    $json = substr($json,0,-2) . ' }] ';
    
    echo $json;
    
    
    ?>

