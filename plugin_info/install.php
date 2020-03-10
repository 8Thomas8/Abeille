<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

require_once dirname(__FILE__) . '/../../../core/php/core.inc.php';

function Abeille_install() {
    $cron = cron::byClassAndFunction('Abeille', 'deamon');
    if (!is_object($cron)) {
        $cron = new cron();
        $cron->setClass('Abeille');
        $cron->setFunction('deamon');
        $cron->setEnable(1);
        $cron->setDeamon(1);
        $cron->setSchedule('* * * * *');
        $cron->setTimeout('1440');
        $cron->save();
    }
}

function Abeille_update() {

    message::add('Abeille', 'Mise à jour en cours...', null, null);
    
    if ( config::byKey('DbVersion', 'Abeille', '') == '' ) {
        
        // ******************************************************************************************************************
        // Update Abeille instance from previous version from Abeille/ to Abeille1/
        // Ruche
        $from   = "zigate";
        $to     = "zigate1";
        $abeilles = Abeille::byType('Abeille');
        foreach ( $abeilles as $abeilleId=>$abeille) {
            if ( preg_match("/^".$from."\//", $abeille->getLogicalId() )) {
                $abeille->setLogicalId( str_replace($from,$to,$abeille->getLogicalId()) );
                $abeille->setName(str_replace( $from, $to, $abeille->getName()) );
                $abeille->setConfiguration('topic', str_replace( $from, $to, $abeille->getConfiguration('topic') ) );
                $abeille->save();
            }
        }
        // Abeille
        $from   = "Abeille";
        $to     = "Abeille1";
        $abeilles = Abeille::byType('Abeille');
        foreach ( $abeilles as $abeilleId=>$abeille) {
            if ( preg_match("/^".$from."\//", $abeille->getLogicalId() )) {
                $abeille->setLogicalId( str_replace($from,$to,$abeille->getLogicalId()) );
                $abeille->setName(str_replace( $from, $to, $abeille->getName()) );
                $abeille->setConfiguration('topic', str_replace( $from, $to, $abeille->getConfiguration('topic') ) );
                $abeille->save();
            }
        }
        config::save( 'zigateNb', '1', 'Abeille' );
        
        config::save( 'deamonAutoMode', '1', 'Abeille' );
        
        config::save( 'AbeilleActiver1', 'Y', 'Abeille' );
        config::save( 'AbeilleActiver2', 'N', 'Abeille' );
        config::save( 'AbeilleActiver3', 'N', 'Abeille' );
        config::save( 'AbeilleActiver4', 'N', 'Abeille' );
        config::save( 'AbeilleActiver5', 'N', 'Abeille' );
        config::save( 'AbeilleActiver6', 'N', 'Abeille' );
        config::save( 'AbeilleActiver7', 'N', 'Abeille' );
        config::save( 'AbeilleActiver8', 'N', 'Abeille' );
        config::save( 'AbeilleActiver9', 'N', 'Abeille' );
        config::save( 'AbeilleActiver10', 'N', 'Abeille' );
        
        if ( config::byKey('AbeilleSerialPort', 'Abeille', '') == '/tmp/zigate' ) {
            config::save( 'AbeilleSerialPort1', '/dev/zigate1', 'Abeille' );
            config::save( 'IpWifiZigate1', config::byKey('IpWifiZigate', 'Abeille', ''), 'Abeille' );
        }
        else {
            config::save( 'AbeilleSerialPort1', config::byKey('AbeilleSerialPort', 'Abeille', ''), 'Abeille' );
        }
        config::save( 'DbVersion', '20200225', 'Abeille' );
    }

    // Clean Config
    config::remove('affichageCmdAdd', 'Abeille');
    config::remove('affichageNetwork', 'Abeille');
    config::remove('affichageTime', 'Abeille');
    
    config::remove('AbeilleSerialPort', 'Abeille');
    config::remove('IpWifiZigate', 'Abeille');
    
    config::remove('AbeilleAddress', 'Abeille');
    config::remove('AbeilleConId', 'Abeille');
    config::remove('AbeillePort', 'Abeille');
    
    config::remove('mqttPass', 'Abeille');
    config::remove('mqttTopic', 'Abeille');
    config::remove('mqttUser', 'Abeille');
    config::remove('onlyTimer', 'Abeille');
    
    message::removeAll('Abeille');
    message::add('Abeille', 'Mise à jour terminée', null, null);
}

function Abeille_remove() {
    $cron = cron::byClassAndFunction('Abeille', 'deamon');
    if (is_object($cron)) {
        $cron->stop();
        $cron->remove();
    }
    log::add('Abeille','info','Suppression extension');
    $resource_path = realpath(dirname(__FILE__) . '/../resources');
    passthru('sudo /bin/bash ' . $resource_path . '/remove.sh ' . $resource_path . ' > ' . log::getPathToLog('Abeille_removal') . ' 2>&1 &');
    message::removeAll("Abeille");
    message::add("Abeille","plugin désinstallé");
}

?>
