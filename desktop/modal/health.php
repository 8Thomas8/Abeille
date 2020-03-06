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

    require_once dirname(__FILE__).'/../../../../core/php/core.inc.php';
    include_once(dirname(__FILE__).'/../../resources/AbeilleDeamon/lib/Tools.php');
    /*
    if (!isConnect('admin')) {
        throw new Exception('401 Unauthorized');
    }
     */
    $eqLogics = Abeille::byType('Abeille');
?>

<table class="table table-condensed tablesorter" id="table_healthAbeille">
    <thead>
    <tr>
        <th>{{Module}}</th>
        <th>{{Name}}</th>
        <th>{{ID}}</th>
        <th>{{Ruche}}</th>
        <th>{{Address}}</th>
        <th>{{IEEE}}</th>
        <th>{{Statut}}</th>
        <th>{{Dernière communication}}</th>
        <th>{{Depuis (h)}}</th>
        <th>{{Date création}}</th>
    </tr>
    </thead>
    <tbody>
    <?php
        // To identify duplicated objet with same IEEE
        $IEEE_Table = array();
        
        foreach ($eqLogics as $eqLogic) {

            // Module
            echo "\n\n\n\n<tr>".'<td><a href="'.$eqLogic->getLinkToConfiguration().'" style="text-decoration: none;">'.$eqLogic->getHumanName(true).'</a></td>';

            // Nom
            echo '<td><span class="label label-info" style="font-size : 1em; cursor : default;">'.$eqLogic->getConfiguration('icone').'</span></td>';
            
            // ID
            echo '<td><span class="label label-info" style="font-size : 1em; cursor : default;">'.$eqLogic->getId().'</span></td>';
            
            $parts = explode("/", $eqLogic->getLogicalId());
            
            // Ruche
            echo '<td><span class="label label-info" style="font-size : 1em; cursor : default;">'.$parts[0].'</span></td>';
            
            // Short Address
            echo '<td><span class="label label-info" style="font-size : 1em; cursor : default;">'.$parts[1].'</span></td>';
            
            // IEEE
            
            // Recupere IEEE de la Ruche/ZiGate
            $commandIEEE = $eqLogic->getCmd('info', 'IEEE-Addr');
            
            if ( $commandIEEE ) {
                $addrIEEE = $commandIEEE->execCmd();
                if (strlen($addrIEEE) > 2 ) {
                    $IEEE_Table[$addrIEEE] = $IEEE_Table[$addrIEEE] + 1;
                }
            }

            if ( $eqLogic->getConfiguration('icone') == "remotecontrol" ) {
                $addrIEEE = "na";
            }
            
            if ( strlen($addrIEEE) == 16 || $addrIEEE=="na") {
                echo '<td><span class="label label-success" style="font-size : 1em; cursor : default;">'.$addrIEEE.'</span></td>';
            }
            else {
                echo '<td><span class="label label-warning" style="font-size : 1em; cursor : default;">'.Missing.'</span></td>';
            }


            // Status
            // Status Ok par defaut, apres on test et on met le status à la valeur voulue
            $status = '<span class="label label-success" style="font-size : 1em; cursor : default;">{{OK}}</span>';
            if ( (time() - strtotime($eqLogic->getStatus('lastCommunication'))) > (60*$eqLogic->getTimeout()) ) {
                 $status = '<span class="label label-warning" style="font-size : 1em; cursor : default;">Time Out Last Communication</span>';
            }
            if ( (time() - strtotime($eqLogic->getStatus('lastCommunication'))) > ((2*60*$eqLogic->getTimeout())) ) {
                $status = '<span class="label label-danger" style="font-size : 1em; cursor : default;">Time Out Last Communication</span>';
            }

            if ($eqLogic->getStatus('state') == '-') {
                $status = '<span class="label label-success" style="font-size : 1em; cursor : default;">-</span>';
            }
            echo '<td>'.$status.'</td>';

            // Derniere Comm
            if ( strlen($eqLogic->getStatus('lastCommunication'))>2 ) {
                $lastComm = '<span class="label label-info" style="font-size : 1em; cursor : default;">'.$eqLogic->getStatus('lastCommunication').'</span>';
            }
            else {
                $lastComm = '<span class="label label-warning" style="font-size : 1em; cursor : default;">No message received !!</span>';
            }
            echo '<td>'.$lastComm.'</td>';

            // Depuis
            $Depuis = '<span class="label label-info" style="font-size : 1em; cursor : default;">'.(floor((time() - strtotime($eqLogic->getStatus('lastCommunication'))) / 3600)).'</span>';
            //if ($eqLogic->getStatus('state') == '-') { $Depuis = '<span class="label label-info" style="font-size : 1em; cursor : default;">-</span>'; }
            echo '<td>'.$Depuis.'</td>';


            // Date Creation
            echo '<td><span class="label label-info" style="font-size : 1em; cursor : default;">'.$eqLogic->getConfiguration('createtime').'</span></td></tr>';
        }
    ?>
    </tbody>
</table>

<?php
foreach ($IEEE_Table as $IEEE=>$IEEE_Device) {
    if ($IEEE_Device>1) { echo "L'adresse ->".$IEEE."<- est dupliquée ce n'est pas normal. On ne doit avoir qu'un équipment par adresse IEEE</br>"; }
}
    ?>
