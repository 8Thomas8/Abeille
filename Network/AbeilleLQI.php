<?php
    
    /***
     * LQI
     *
     * Send LQI request to the network
     * Process 804E answer messages
     * to draw LQI (Link Quality Indicator)
     * to draw NE Hierarchy
     *
     */
    
    require_once dirname(__FILE__) . "/../../../core/php/core.inc.php";
    require_once("../resources/AbeilleDeamon/lib/Tools.php");
    require_once("../resources/AbeilleDeamon/includes/config.php");
    require_once("../resources/AbeilleDeamon/includes/fifo.php");
    require_once("../resources/AbeilleDeamon/includes/function.php");
    
    /*
    // Il faut plusieures queues entre les process, on ne peut pas avoir un pot pourri pour tous comme avec Mosquitto.
    // 1: Abeille
    // 2: AbeilleParser -> Parser
    // 3: AbeilleMQTTCmd -> Cmd
    // 4: AbeilleTimer  -> Timer
    // 5: AbeilleLQI -> LQI
    
    // 221: means AbeilleParser to(2) Abeille
    define('queueKeyAbeilleToAbeille',  121);
    define('queueKeyAbeilleToCmd',      123);
    define('queueKeyAbeilleToTimer',    124);
    define('queueKeyCmdToAbeille',      321);
    define('queueKeyParserToAbeille',   221);
    define('queueKeyParserToCmd',       223);
    define('queueKeyCmdToCmd',          323);
    define('queueKeyTimerToAbeille',    421);
    define('queueKeyLQIToCmd',          523);
    define('queueKeyParserToLQI',       223);
    
    Class MsgAbeille {
        public $message = array(
                                'topic' => 'Coucou',
                                'payload' => 'me voici',
                                );
    }
*/
    
    function benLog($message = "")
    {
        global $debugKiwi;
        if ($debugKiwi && strlen($message) > 0) echo $message . "<br>\n";
    }
    
    // ---------------------------------------------------------------------------------------------------------------------------
    function message()
    {
        global $qos;
        global $abeilleParameters;
        global $queueKeyParserToLQI;
        
        benLog("Check if message");
        
        $max_msg_size = 512;
        
        if (msg_receive( $queueKeyParserToLQI, 0, $msg_type, $max_msg_size, $msg, true, MSG_IPC_NOWAIT)) {
            $message->topic = $msg->message['topic'];
            $message->payload = $msg->message['payload'];
        }
        else {
            return;
        }
        
        benLog("Message: ".json_encode( $message ) );
        
        $NE_All_local = &$GLOBALS['NE_All_BuildFromLQI'];
        $knownNE_local = &$GLOBALS['knownNE_FromAbeille'];
         
        benLog("Message Topic: ".$message->topic);
        
        if (strpos( "_".$message->topic, "LQI") != 1) {
            echo "LQI not\n";
            return;
        }
        
        // Crée les variables dans la chaine et associe la valeur.
        $parameters = proper_parse_str($message->payload);
        
        // Si je recois des message vide c'est que je suis à la fin de la table et je demande l arret de l envoie des requetes LQI
        // et je dis que le NE a ete interrogé
        if ($parameters['BitmapOfAttributes'] == "") {
            $GLOBALS['NE_continue'] = 0;
            // check si le NE existe deja, si oui je le marque fait, sinon je l ajoute à la liste pour le prochain passage
            if (isset($NE_All_local[$GLOBALS['NE']])) {
                $NE_All_local[$GLOBALS['NE']] = array("LQI_Done" => 0);
            } else {
                $NE_All_local[$GLOBALS['NE']] = array("LQI_Done" => 1);
            }
            
            return;
        }
        
        $parameters['NE'] = $GLOBALS['NE'];
        $parameters['NE_Name'] = ($parameters['NE'] == '0000') ? 'Ruche' : $knownNE_local[$parameters['NE']];
        if (strlen($parameters['NE_Name']) == 0) {
            $parameters['NE_Name'] = "Inconnu-" . $parameters['IEEE_Address'];
        }
        
        $topicArray = explode("/", $message->topic);
        $parameters['Voisine'] = $topicArray[1];
        $parameters['Voisine_Name'] = $knownNE_local[$parameters['Voisine']]; // array_search($topicArray[1], $knownNE_local); //$knownNE_local[$parameters['Voisine']];
        
        // echo "Voisine: " . $parameters['Voisine'] . " Voisine Name: " . $parameters['Voisine_Name'] . "\n";
        
        // Decode Bitmap Attribut
        // Bit map of attributes Described below: uint8_t
        // bit 0-1 Device Type (0-Coordinator 1-Router 2-End Device)    => Process
        // bit 2-3 Permit Join status (1- On 0-Off)                     => Skip no need for the time being
        // bit 4-5 Relationship (0-Parent 1-Child 2-Sibling)            => Process
        // bit 6-7 Rx On When Idle status (1-On 0-Off)                  => Process
        if ((hexdec($parameters['BitmapOfAttributes']) & 0b00000011) == 0x00) {
            $parameters['Type'] = "Coordinator";
        }
        if ((hexdec($parameters['BitmapOfAttributes']) & 0b00000011) == 0x01) {
            $parameters['Type'] = "Router";
            if (isset($NE_All_local[$parameters['Voisine']])) { // deja dans la list donc on ne fait rien
            } else {
                $NE_All_local[$parameters['Voisine']] = array("LQI_Done" => 0);
            }
        }
        if ((hexdec($parameters['BitmapOfAttributes']) & 0b00000011) == 0x02) {
            $parameters['Type'] = "End Device";
        }
        if ((hexdec($parameters['BitmapOfAttributes']) & 0b00000011) == 0x03) {
            $parameters['Type'] = "Unknown";
        }
        
        if ((hexdec($parameters['BitmapOfAttributes']) & 0b00110000) == 0x00) {
            $parameters['Relationship'] = "Parent";
        }
        if ((hexdec($parameters['BitmapOfAttributes']) & 0b00110000) == 0x10) {
            $parameters['Relationship'] = "Child";
        }
        if ((hexdec($parameters['BitmapOfAttributes']) & 0b00110000) == 0x20) {
            $parameters['Relationship'] = "Sibling";
        }
        if ((hexdec($parameters['BitmapOfAttributes']) & 0b00110000) == 0x30) {
            $parameters['Relationship'] = "Unknown";
        }
        
        if ((hexdec($parameters['BitmapOfAttributes']) & 0b11000000) == 0x00) {
            $parameters['Rx'] = "Rx-Off";
        }
        if ((hexdec($parameters['BitmapOfAttributes']) & 0b11000000) == 0x40) {
            $parameters['Rx'] = "Rx-On";
        }
        if ((hexdec($parameters['BitmapOfAttributes']) & 0b11000000) == 0x80) {
            $parameters['Rx'] = "Rx-Unknown";
        }
        if ((hexdec($parameters['BitmapOfAttributes']) & 0b11000000) == 0xC0) {
            $parameters['Rx'] = "Rx-Unknown";
        }
        
        $parameters['LinkQualityDec'] = hexdec($parameters['LinkQuality']);
        
        // print_r( $parameters );
        
        $GLOBALS['LQI'][] = $parameters;
        
        // Envoie de l'adresse IEEE a Abeille pour completer les objets.
        // e.g. Abeille/d45e/IEEE-Addr
        // $mqtt = $GLOBALS['client'];
        //$mqtt->publish(substr($abeilleParameters['AbeilleTopic'],0,-1)."Abeille/" . $parameters['Voisine'] . "/IEEE-Addr", $parameters['IEEE_Address'], $qos);
        
    }
    
    
    /*
     + * Send a mosquitto message to jeedom
     + *
     + * Ask NE at address to provide LQI from its table at index index
     + */
    function mqqtPublishLQI( $serial, $destAddr, $index )
    {
        // global $abeilleParameters;
        // $mqtt->publish(substr($abeilleParameters['AbeilleTopic'],0,-1)."CmdAbeille/Ruche/Management_LQI_request", "address=" . $destAddr . "&StartIndex=" . $index, $qos);
        
        global $queueKeyLQIToCmd;
        
        $msgAbeille = new MsgAbeille;
        
        $msgAbeille->message['topic'] = "Cmd".$serial."/Ruche/Management_LQI_request";
        $msgAbeille->message['payload'] = "address=" . $destAddr . "&StartIndex=" . $index;
        
        benLog("publishLQI: ".json_encode($msgAbeille));
        
        if (msg_send( $queueKeyLQIToCmd, 1, $msgAbeille, true, false)) {
            log::add('Abeille', 'debug', '(AbeilleLQI - mqqtPublishLQI) Msg sent: '.json_encode(msg_stat_queue($msgAbeille)));
        }
        else {
            log::add('Abeille', 'debug', '(AbeilleLQI - mqqtPublishLQI) Could not send Msg');
        }

        
    }
    
    
    function hex2str($hex)
    {
        $str = '';
        for ($i = 0; $i < strlen($hex); $i += 2) {
            $str .= chr(hexdec(substr($hex, $i, 2)));
        }
        
        return $str;
    }
    
    function displayClusterId($cluster)
    {
        return 'Cluster ID: ' . $cluster . '-' . $GLOBALS['clusterTab']["0x" . $cluster];
    }
    
    function collectInformation( $serial, $client, $NE)
    {
        $indexTable = 0;
        
        while ($GLOBALS['NE_continue']) {

            mqqtPublishLQI( $serial, $NE, sprintf("%'.02x", $indexTable) );
            
            $indexTable++;
            // if ($indexTable > count($GLOBALS['knownNE'])+10) {
            // Pour l instant je met une valeur en dure. 30 voisines max.
            if ($indexTable > 30) {
                $GLOBALS['NE_continue'] = 0;
            }
            // usleep(100);
            // $client->loop(5000);
            for ($i = 1; $i <= 3; $i++) {
                message();
                sleep(1);
            }
            
            
            
        }
        // On vide les derniers messages qui trainent
        sleep(1);
        message();
        // $client->loop(5000);
        sleep(1);
        message();
        // $client->loop(5000);
        sleep(1);
        message();
        // $client->loop(5000);
        
    }
    
    /*--------------------------------------------------------------------------------------------------*/
    /* Main
     /*--------------------------------------------------------------------------------------------------*/
    
    $debugKiwi = 1;
    $abeilleParameters = Abeille::getParameters();
    
    benLog('Start Main');
    
    benLog('Get[zigate] = '.$_GET['zigate'] );
    if ( $_GET['zigate']<1 or $_GET['zigate']>5 ) {
        benLog("Mauvaise valeur de zigate !!!!");
        return;
    }
    
    if ( $_GET['zigate'] == 1 ) $port = ""; else $port = $_GET['zigate'];
    
    $serial = $abeilleParameters[ "AbeilleSerialPort".$port ];
    $serial = substr( $serial, 5 );
    
    benLog( $serial );
    
    benLog( "abeilleParameters: ".json_encode($abeilleParameters) );
    
    $queueKeyLQIToCmd       = msg_get_queue( queueKeyLQIToCmd );
    $queueKeyParserToLQI    = msg_get_queue( queueKeyParserToLQI );
    
    $DataFile = "AbeilleLQI_MapData.json";
    $FileLock = $DataFile . ".lock";
    $nbwritten = 0;
    
    if (file_exists($FileLock)) {
        $content = file_get_contents($FileLock);
        benLog($FileLock . ' content: ' . $content);
        if (strpos("_".$content, "done") != 1) {
            echo 'Oops, une collecte est déja en cours... Veuillez attendre la fin de l\'opération';
            benLog('debug', 'Une collecte est probablement en cours, fichier lock present, exit.');
            exit;
        }
    }
    
    $nbwritten = file_put_contents($FileLock, "init");
    if ($nbwritten<1) {
        unlink($FileLock);
        echo 'Oops, je ne peux pas écrire sur ' . $FileLock;
        exit;
    }
    
    // On recupere les infos d'Abeille
    $knownNE_FromAbeille = array();
    $eqLogics = eqLogic::byType('Abeille');
    foreach ($eqLogics as $eqLogic) {
        $name = $eqLogic->getName();
        $topicArray = explode("/", $eqLogic->getLogicalId());
        $shortAddress = $topicArray[1];
        $shortAddress = ( preg_match("(Ruche)", $name) ) ? "0000" : $shortAddress;
        // $knownNE_FromAbeille[$name] = $shortAddress;
        $knownNE_FromAbeille[$shortAddress] = $name;
    }
    
    benLog("NE connus pas Abeille");
    benLog( json_encode($knownNE_FromAbeille) );
    benLog( "----------------------------------");
    
    
    // $clusterTab = Tools::getJSonConfigFiles("zigateClusters.json");
    
    $LQI = array();
    
    benLog( "DEBUT: ".date(DATE_RFC2822)."<br>");
    //lqiLog('debug', '---------: definition et connection a mosquitto');
         
    // Let's start with the Coordinator
    benLog( "---------: Let s start with the Coordinator");
    //lqiLog('debug', '---------: Let s start with the Coordinator');
    $NE_All_BuildFromLQI = array();
    $NE_All_BuildFromLQI["0000"] = array("LQI_Done" => 0);
    
    //exists in knownNE
    //collectInformation($client, $NE);
    // $NE_All[$NE]['LQI_Done'] = 1;
    
    // Let's start at least with 0000
    $NE_All_continue = 1;   // Controle le while sur la liste des NE
    $NE_continue = 1;       // controle la boucle sur l interrogation de la table des voisines d un NE particulier
    
    // Let's start the loop to collect all LQI
    while ($NE_All_continue) {
        
        // Par defaut je ne continu pas. Si je trouve au moins un NE je continue, je ferai donc une boucle à vide à la fin.
        $NE_All_continue = 0;
        
        // Let's continue with Routers found
        // foreach ($knownNE as $name => $neAddress) {
        foreach ($NE_All_BuildFromLQI as $currentNeAddress => $currentNeStatus) {
            benLog("=============================================================");
            benLog("Start Loop");
            
            //-----------------------------------------------------------------------------
            // Estimation du travail restant et info dans le fichier lock
            $total = count($NE_All_BuildFromLQI);
            $done = 0;
            foreach ($NE_All_BuildFromLQI as $neAddressProgress => $neStatusProgress) {
                if ($neStatusProgress['LQI_Done'] == 1) {
                    $done++;
                }
            }
            benLog("AbeilleLQI main: " . $done . " of " . $total);
            
            //-----------------------------------------------------------------------------
            
            // Variable globale qui me permet de savoir quel NE on est en cours d'interrogation car dans le message de retour je n'ai pas cette info.
            $NE = $currentNeAddress;
            
            $name = $knownNE_FromAbeille[$currentNeAddress];
            if (strlen($name) == 0) {
                $name = "Inconnu-" . $currentNeAddress;
            }
            
            $nbwritten = file_put_contents($FileLock, $done . " of " . $total . ' (' . $name . ' - ' . $currentNeAddress . ')');
            if ($nbwritten<1) {
                unlink($FileLock);
                echo 'Oops, je ne peux pas écrire sur ' . $FileLock;
                exit;
            }
            
            benLog('AbeilleLQI main: Interrogation de ' . $name . ' - ' . $currentNeAddress );
            benLog( json_encode($NE_All_BuildFromLQI) );
            
            if ($currentNeStatus['LQI_Done'] == 0) {
                // echo "Let s do\n";
                // $NE = $neAddress;
                $NE_All_continue = 1;
                $NE_continue = 1;
                benLog('AbeilleLQI main: Interrogation de ' . $name . ' - ' . $currentNeAddress  . " -> Je lance la collecte");
                sleep(5);
                collectInformation( $serial, $client, $currentNeAddress);
                $NE_All_BuildFromLQI[$NE]['LQI_Done'] = 1;
            } else {
                // echo "Already done\n";
            }
        }
        
    }
        
    //announce end of processing
    file_put_contents($FileLock, "done - ".date('l jS \of F Y h:i:s A'));
    
    // encode array to json
    $json = json_encode(array('data' => $LQI));
    
    //write json to file
    if (file_put_contents($DataFile, $json)) {
        echo "JSON file created successfully...\n";
    }
    else {
        unlink($DataFile);
        echo "Oops! Error creating json file...\n";
    }
    
    // Formating pour la doc asciidoc
    if (0) {
        // echo "<table>\n";
        // echo "<tr><td>NE</td><td>Voisine</td><td>Relation</td><td>Profondeur</td><td>LQI</td></tr>\n";
        echo "|NE|Voisine|Relation|Profondeur|LQI\n";
        
        foreach ($LQI as $key => $voisine) {
            // echo "<tr>";
            // echo "<td>".$voisine['NE']."</td><td>".$voisine['Voisine']."</td><td>".$voisine['Relationship']."</td><td>".$voisine['Depth']."</td><td>".$voisine['LinkQualityDec']."</td>";
            
            echo "|" . $voisine['NE'] . "|" . $voisine['NE_Name'] . "|" . $voisine['Voisine'] . "|" . "|" . $voisine['Voisine_Name'] . "|" . $voisine['Relationship'] . "|" . $voisine['Depth'] . "|" . $voisine['LinkQualityDec'] . "\n";
            
            // echo "</tr>\n";
        }
        // echo "</table>\n";
    }
    
    // print_r( $NE_All );
    // print_r( $voisine );
    // print_r( $LQI );
    
    ?>
