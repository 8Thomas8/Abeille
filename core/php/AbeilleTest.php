<?php
/*
 This php code allow to inkect messages in the system while it's running for tests purposes
 Set the "if condition" to run the test you want.
*/

    include_once __DIR__.'/../../../../core/php/core.inc.php';
    include_once __DIR__.'/../../resources/AbeilleDeamon/includes/config.php';
    include_once __DIR__.'/../../resources/AbeilleDeamon/includes/function.php';
    include_once __DIR__.'/../../resources/AbeilleDeamon/includes/fifo.php';

    include_once __DIR__.'/AbeilleLog.php';

    include_once __DIR__.'/../class/AbeilleCmdQueue.class.php';

    $abeilleCmdQueue = new AbeilleCmdQueue('debug');
    $message = new object();
    $message->priority = 1;

    $test = $argv[1];
    echo "Running test: ".$test."\n";
    
    if ($test==1) {
        echo "Send a command in binary format directly to AbeilleCMd to be written on serie port\n";
        $cmdQueue->sendCmdToZigate( 'Abeille1', '0092', '0006', "0283E4010102" );
    }

    // Send a L2 Command to the queue to be processed 
    if ( (100<=$test) && ($test<200) ) {
        
        if ($test==100) {
            echo "Test pour BSO\n";
            $message->topic = 'CmdAbeille1/25c9/moveToLiftAndTiltBSO';
            $message->payload = 'EP=01&Inclinaison=60&duration=FFFF';
        }  
        
        if ($test==101) {
            echo "On Off Test\n";
            $message->topic = 'CmdAbeille1/83E4/OnOff';
            $message->payload = 'Action=Toggle&EP=01';
        }

        if ($test==102) {
            echo "Reset Ruche\n";
            $message->topic = 'CmdAbeille1/Ruche/reset';
            $message->payload = 'reset';
        }
        
        if ($test==103) {
            echo "Used to Test PDM messages and dev the PDM feature\n";
            $message->topic = 'CmdAbeille1/Ruche/PDM';
            $message->payload = 'E_SL_MSG_PDM_HOST_AVAILABLE';
        }

        $cmdQueue->procmsg($message);
        $cmdQueue->processCmdQueueToZigate();
    }

    // Send a message to Abeille's queue
    if ( (200<=$test) && ($test<300) ) {
        if ($test==200) {
            echo "Send a Systeme Message to the Ruche to be used by a scenario by the user\n";
            // public static function publishMosquitto($queueId, $priority, $topic, $payload)
            Abeille::publishMosquitto(queueKeyAbeilleToAbeille, priorityInterrogation, "Abeille1/Ruche/SystemMessage", "Le message");
        }

        
    }
?>
