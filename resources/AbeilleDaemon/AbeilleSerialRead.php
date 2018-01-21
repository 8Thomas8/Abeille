<?php
    include("includes/config.php");
    include("includes/fifo.php");
    
    function _exec($cmd, &$out = null)
    {
        $desc = array(
                      1 => array("pipe", "w"),
                      2 => array("pipe", "w")
                      );
        
        $proc = proc_open($cmd, $desc, $pipes);
        
        $ret = stream_get_contents($pipes[1]);
        $err = stream_get_contents($pipes[2]);
        
        fclose($pipes[1]);
        fclose($pipes[2]);
        
        $retVal = proc_close($proc);
        
        if (func_num_args() == 2) {
            $out = array($ret, $err);
        }
        
        return $retVal;
    }
    
    
    if (!file_exists($argv[1]))
    { echo "Error: Fichier ".$argv[1]." n existe pas\n";
        exit(1);
    }
    
    echo "Serial port used: ".$argv[1]."\n";
    
    $fifoIN = new fifo( $in, 'w+' );
    
    _exec("stty -F ".$argv[1]." speed 115200 cs8 -parenb -cstopb raw",$out);
    
    $f = fopen($argv[0], "r");
    
    print_r( $f ); echo "\n";
    
    $transcodage=false;
    $trame="";
    $test="";
    
    while (true)
    {
    if (!file_exists($argv[1]))
    { echo "Fichier ".$argv[1]." n existe pas\n";
        exit(1);
    }
    
        $car=fread($f,01);
        
        $car=bin2hex($car);
        if ($car=="01")
        {
            $trame="";
        }
        else if ($car=="03")
        {
            echo date("Y-m-d H:i:s")." -> ".$trame."\n";
            $fifoIN->write($trame."\n");
        }else if($car=="02")
        {
            $transcodage=true;
        }else{
            if ($transcodage)
            {
                $trame.= sprintf("%02X",(hexdec($car) ^ 0x10));
                
            }else{
                
                $trame.=$car;
            }
            $transcodage=false;
        }
        
    }
    
    fclose($f);
    $fifoIN->close();
    
    ?>
