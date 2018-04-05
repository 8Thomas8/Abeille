<?php
    

    $knownNE = array(
                     "0000" => "Ruche",         // 00:15:8d:00:01:b2:2e:24
                     
                     "dc15" => "T1",
                     "8662" => "T2",
                     "174f" => "T3",            // 00:0b:57:ff:fe:49:10:ea
                     "6766" => "T4",
                     "1b7b" => "T5",
                     "8ffe" => "T6",
                     
                     "a0da" => "Gauche",
                     // "0cd5" => "Milieu",
                     "60fb" => "Milieu",
                     "46d9" => "Droite",        // 00:0b:57:ff:fe:95:2a:69
                     "a728" => "Piano",         // 00:0b:57:ff:fe:3a:0e:7c
                     
                     "345f" => "P-D",
                     "2349" => "P-G",
                     "f984" => "P-C",
                     
                     "d922" => "P-Entree",
                     
                     
                     "41c0" => "PriseX1",       // 00:15:8d:00:01:83:af:7b
                     "db83" => "PriseX2",       // 00:15:8d:00:01:83:af:eb
                     
                     "498d" => "HueGo",         // 00:17:88:01:02:14:ff:6b
                     
                     "7714" => "Bois",          // 00:0b:57:ff:fe:4b:ab:6a
                     
                     "873a" => "IR",
                     
                     "b774" => "Porte Bureau",
                     "1be0" => "Temperature Bureau",
                   
                     "28f2" => "Fenetre SdB",
                     
                     "5571" => "Grad-Bureau",
                     
                     "9573" => "Inconnu",
                     
                     
                     );

    
    
    $Abeilles = array(
                      'Ruche'    => array('position' => array( 'x'=>670, 'y'=>500), 'color'=>'red',),
                      
                      'T1'       => array('position' => array( 'x'=>300, 'y'=>450), 'color'=>'orange',),
                      'T2'       => array('position' => array( 'x'=>400, 'y'=>450), 'color'=>'orange',),
                      'T3'       => array('position' => array( 'x'=>450, 'y'=>350), 'color'=>'orange',),
                      'T4'       => array('position' => array( 'x'=>450, 'y'=>250), 'color'=>'orange',),
                      'T5'       => array('position' => array( 'x'=>500, 'y'=>200), 'color'=>'orange',),
                      'T6'       => array('position' => array( 'x'=>600, 'y'=>200), 'color'=>'orange',),
                      
                      'Gauche'    => array('position' => array( 'x'=>700, 'y'=>300), 'color'=>'orange',),
                      'Milieu'    => array('position' => array( 'x'=>650, 'y'=>300), 'color'=>'orange',),
                      'Droite'    => array('position' => array( 'x'=>650, 'y'=>350), 'color'=>'orange',),
                      'Piano'     => array('position' => array( 'x'=>720, 'y'=>400), 'color'=>'orange',),
                      
                      'P-D' => array('position' => array( 'x'=>625, 'y'=>300), 'color'=>'grey',),
                      'P-G' => array('position' => array( 'x'=>625, 'y'=>350), 'color'=>'grey',),
                      'P-C' => array('position' => array( 'x'=>500, 'y'=>500), 'color'=>'grey',),
                      
                      'P-Entree' => array('position' => array( 'x'=>625, 'y'=>700), 'color'=>'grey',),
                      
                      'PriseX1' => array('position' => array( 'x'=>650, 'y'=>500), 'color'=>'orange',),
                      'PriseX2' => array('position' => array( 'x'=>650, 'y'=>520), 'color'=>'orange',),
                      
                      'HueGo' => array('position' => array( 'x'=>650, 'y'=>480), 'color'=>'orange',),
                      
                      'Bois' => array('position' => array( 'x'=>670, 'y'=>480), 'color'=>'orange',),
                    
                      'IR' => array('position' => array( 'x'=>690, 'y'=>480), 'color'=>'grey',),
                      
                      'Porte Bureau' => array('position' => array( 'x'=>725, 'y'=>480), 'color'=>'grey',),
                      'Temperature Bureau' => array('position' => array( 'x'=>710, 'y'=>480), 'color'=>'grey',),
                      
                      'Fenetre SdB' => array('position' => array( 'x'=>800, 'y'=>480), 'color'=>'grey',),
                      
                      'Grad-Bureau' => array('position' => array( 'x'=>700, 'y'=>500), 'color'=>'green',),
                      
                      'Inconnu' => array('position' => array( 'x'=>720, 'y'=>500), 'color'=>'yellow',),
                      
                      );
    
    $liaisonsRadio = array(
                           'Ruche-T3'   => array( 'source'=>'Ruche', 'destination'=>'T3'    ),
                           'T3-T5'      => array( 'source'=>'T3', 'destination'=>'T5'       ),
                           'T3-Ruche'   => array( 'source'=>'T3', 'destination'=>'Ruche'    ),
                           );
    ?>



