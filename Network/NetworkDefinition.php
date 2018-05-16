<?php
    

    $knownNE = array(
                     "0000" => "Ruche",         // 00:15:8d:00:01:b2:2e:24 00158d0001b22e24 -> Production
                                                // 00:01:58:d0:00:19:1b:22 000158d000191b22 -> Test
 // Abeille Prod JeedomZwave
                     "dc15" => "T1",            // 00:0B:57:ff:fe:49:0D:bf 000B57fffe490Dbf
                     "1e8c" => "T2",
                     "174f" => "T3",            // 00:0b:57:ff:fe:49:10:ea
                     "6766" => "T4",
                     "1b7b" => "T5",
                     "8ffe" => "T6",
                     "2096" => "T7",
                     "2cd5" => "T8",
                     
                     "a0da" => "Gauche",
                     // "0cd5" => "Milieu",
                     "60fb" => "Milieu",
                     "46d9" => "Droite",        // 00:0b:57:ff:fe:95:2a:69
                     "a728" => "Piano",         // 00:0b:57:ff:fe:3a:0e:7c
                     
                     "345f" => "P-D",
                     "2349" => "P-G",           // 00:15:8d:00:01:b1:49:a8
                     "fb14" => "P-C",		// 	fut f984
                     
                     "8f28" => "P-Entree",
                     
                     
                     "41c0" => "PriseX1",       // 00:15:8d:00:01:83:af:7b
                     "db83" => "PriseX2",       // 00:15:8d:00:01:83:af:eb
                     "d86d" => "PriseXTest",    // 00:15:8d:00:01:dc:9c:42 00158d0001dc9c42
                     
                     "498d" => "HueGo",         // 00:17:88:01:02:14:ff:6b
                     
                     "7714" => "Bois",          // 00:0b:57:ff:fe:4b:ab:6a
                     
                     "873a" => "IR",
                     
                     "b774" => "Porte Bureau",
                     "1be0" => "Temperature Bureau",
                   
                     "d43e" => "Fenetre SdB G",
                     "28f2" => "Fenetre SdB D",
                     
                     "5571" => "Grad-Bureau",
                     
                     "e4c0" => "Ch Parent Ben",
                     
                     "eb79" => "Sonnette",

                     "0F7e" => "Inconnu1", 		// 90:fd:9f:ff:fe:16:5c:2c
                     
                     "137f" => "Velux-SdB-Tour",
                     "e311" => "Velux-Lulu",		// fut 4c3a

                     "c551" => "Old-Off-Network-1", 	// 00:0B:57:ff:fe:8d:70:73
                     
                     
                     
  // Abeille Test abeille
                     "c360" => "Test: Temperature Rond Bureau",     // 00:15:8d:00:01:9f:91:99 fut df33
                     "fdb4" => "Test: Door V1 Bureau",              // 00:15:8d:00:01:d8:6c:3e fut a008
                     "26a7" => "Test: Inondation Bureau",           // 00:15:8d:00:01:bb:6b:49 00158d0001bb6b49 fut 7bd5
                     "5b7a" => "Test: Bouton Carre V2 Bureau",      // 00:15:8d:00:01:a6:6c:a3 00158d0001a66ca3 fut dcd9, de4d, d09c
                     "63b9" => "Test: Door V0 Bureau",              // 00:15:8d:00:02:01:47:f9 00158d00020147f9 fut 3950
                     "0113" => "Test: IR Pied Bureau",              // 00:15:8d:00:01:dd:b1:f7 00158d0001ddb1f7 fut 5dea
                     "060B" => "Test: Interrupteur Rond",           // 00:15:8d:00:01:f3:af:91 00158d0001f3af91 fut 4ebd
                     "76fb" => "Test: xxxxxx",                      // 00:0B:57:ff:fe:2c:82:e9 000B57fffe2c82e9 fut 633e, 0Ab5, 0Eb5
                     "c7c0" => "Test: RI V0",                       // 00:15:8d:00:01:dc:15:88
                     "d45e" => "Test: Ampoule Z Bureau",            // 90:fd:9f:ff:fe:69:13:1d 90fd9ffffe69131d
                     "ceb8" => "Test: Ampoule 2",                   // 00:0B:57:ff:fe:c0:07:b5 000B57fffec007b5
                     "2389" => "Test: Detecteur Smoke",             // 00:15:8d:00:01:b7:b2:a2
                     "633e" => "Test:Old Address changed 1",        //
                     "b8fc" => "Test: Wall Switch",                 // 00:15:8d:00:01:f4:6b:79 00158d0001f46b79 - AC Power - Rx When Idle = False
                     
                     );

    
    
    $Abeilles = array(
                      'Ruche'    => array('position' => array( 'x'=>700, 'y'=>520), 'color'=>'red',),
    // Abeille Prod JeedomZwave
	// Terrasse
                      'T1'       => array('position' => array( 'x'=>300, 'y'=>450), 'color'=>'orange',),
                      'T2'       => array('position' => array( 'x'=>400, 'y'=>450), 'color'=>'orange',),
                      'T3'       => array('position' => array( 'x'=>450, 'y'=>350), 'color'=>'orange',),
                      'T4'       => array('position' => array( 'x'=>450, 'y'=>250), 'color'=>'orange',),
                      'T5'       => array('position' => array( 'x'=>500, 'y'=>200), 'color'=>'orange',),
                      'T6'       => array('position' => array( 'x'=>600, 'y'=>200), 'color'=>'orange',),
                      'T7'       => array('position' => array( 'x'=>625, 'y'=>450), 'color'=>'orange',),
                      'T8'       => array('position' => array( 'x'=>450, 'y'=>500), 'color'=>'orange',),
        // Salon              
                      'Gauche'    => array('position' => array( 'x'=>750, 'y'=>300), 'color'=>'orange',),
                      'Milieu'    => array('position' => array( 'x'=>650, 'y'=>300), 'color'=>'orange',),
                      'Droite'    => array('position' => array( 'x'=>650, 'y'=>350), 'color'=>'orange',),
                      'Piano'     => array('position' => array( 'x'=>720, 'y'=>400), 'color'=>'orange',),
                      
                      'P-D' => array('position' => array( 'x'=>625, 'y'=>300), 'color'=>'grey',),
                      'P-G' => array('position' => array( 'x'=>625, 'y'=>350), 'color'=>'grey',),
                      'P-C' => array('position' => array( 'x'=>500, 'y'=>500), 'color'=>'grey',),
                      
                      'P-Entree' => array('position' => array( 'x'=>625, 'y'=>700), 'color'=>'grey',),
                      
                      'HueGo' 			=> array('position' => array( 'x'=>650, 'y'=>480), 'color'=>'orange',),
                      'PriseX1' 		=> array('position' => array( 'x'=>325, 'y'=>525), 'color'=>'orange',),
                      'PriseX2' 		=> array('position' => array( 'x'=>750, 'y'=>450), 'color'=>'orange',),
                      'PriseXTest'      => array('position' => array( 'x'=>725, 'y'=>300), 'color'=>'orange',),
                      
                      'Bois' 			=> array('position' => array( 'x'=>700, 'y'=>480), 'color'=>'orange',),
                      'Grad-Bureau' 		=> array('position' => array( 'x'=>700, 'y'=>500), 'color'=>'green',),
                    
                      'IR' 			=> array('position' => array( 'x'=>750, 'y'=>480), 'color'=>'grey',),
                      'Temperature Bureau' 	=> array('position' => array( 'x'=>750, 'y'=>500), 'color'=>'grey',),
                      'Porte Bureau' 		=> array('position' => array( 'x'=>750, 'y'=>520), 'color'=>'grey',),
                      
                      
                      'Fenetre SdB G' => array('position' => array( 'x'=>800, 'y'=>400), 'color'=>'grey',),
                      'Fenetre SdB D' => array('position' => array( 'x'=>800, 'y'=>425), 'color'=>'grey',),
                      
                      
                      
                      'Ch Parent Ben' => array('position' => array( 'x'=>650, 'y'=>275), 'color'=>'yellow',),
                      
                      'Sonnette' => array('position' => array( 'x'=>625, 'y'=>650), 'color'=>'grey',),
                      
                      'Velux-SdB-Tour'  => array('position' => array( 'x'=>300, 'y'=>525), 'color'=>'grey',),
                      'Velux-Lulu'      => array('position' => array( 'x'=>300, 'y'=>575), 'color'=>'grey',),
                      
                      'Inconnu1' 			=> array('position' => array( 'x'=>900, 'y'=>75), 'color'=>'purple',),
                      'Old-Off-Network-1'            	=> array('position' => array( 'x'=>900, 'y'=>100), 'color'=>'purple',),

                      
                      // Abeille Test abeille
                      "Test: Temperature Rond Bureau"   => array('position' => array( 'x'=>100, 'y'=>100), 'color'=>'grey',),
                      "Test: Door V1 Bureau"            => array('position' => array( 'x'=>100, 'y'=>150), 'color'=>'grey',),
                      "Test: Inondation Bureau"         => array('position' => array( 'x'=>100, 'y'=>200), 'color'=>'grey',),
                      "Test: Bouton Carre V2 Bureau"    => array('position' => array( 'x'=>100, 'y'=>250), 'color'=>'grey',),
                      "Test: Door V0 Bureau"            => array('position' => array( 'x'=>100, 'y'=>300), 'color'=>'grey',),
                      "Test: IR Pied Bureau"            => array('position' => array( 'x'=>100, 'y'=>350), 'color'=>'grey',),
                      "Test: Interrupteur Rond"         => array('position' => array( 'x'=>100, 'y'=>400), 'color'=>'grey',),
                      "Test: xxxxxx"                    => array('position' => array( 'x'=>100, 'y'=>450), 'color'=>'grey',),
                      "Test: RI V0"                     => array('position' => array( 'x'=>100, 'y'=>500), 'color'=>'grey',),
                      "Test: Ampoule Z Bureau"          => array('position' => array( 'x'=>050, 'y'=>525), 'color'=>'orange',),
                      "Test: Ampoule 2"                 => array('position' => array( 'x'=>150, 'y'=>575), 'color'=>'orange',),
                      "Test: Detecteur Smoke"           => array('position' => array( 'x'=>100, 'y'=>600), 'color'=>'grey',),

                      "Test:Old Address changed 1"      => array('position' => array( 'x'=>900, 'y'=>600), 'color'=>'purple',),
                      "Test: Wall Switch"               => array('position' => array( 'x'=>900, 'y'=>700), 'color'=>'orange',),
                      );
    
    // $liaisonsRadio = array(
                           // 'Ruche-T3'   => array( 'source'=>'Ruche', 'destination'=>'T3'    ),
                           // 'T3-T5'      => array( 'source'=>'T3', 'destination'=>'T5'       ),
                           // 'T3-Ruche'   => array( 'source'=>'T3', 'destination'=>'Ruche'    ),
                           // );
    ?>



