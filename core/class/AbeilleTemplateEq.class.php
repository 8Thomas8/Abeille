<?php

class AbeilleTemplateEq
{
    /**
     * Will retour the Template (uniqId) used by an Abeille
     *
     * @return          Return retour the Template (uniqId) used by an Abeille
     */
    public static function uniqIdUsedByAnAbeille( $logicalId ) {
        return Abeille::byLogicalId( $logicalId, 'Abeille', false )->getConfiguration('uniqId', '');
    }

    /**
     * Will collect all Abeille with a specific template (uniqId)
     *
     * @return          Return all abeille with a specific template (uniqId)
     */
    public static function getEqLogicsByTemplateUniqId( $uniqId ) {
        // uniqId
        $allAbeillesWithUniqId = Abeille::byTypeAndSearhConfiguration( 'Abeille', 'uniqId' );

        foreach ( $allAbeillesWithUniqId as $key=>$abeillesWithUniqId ) {
            if ( $abeillesWithUniqId->getConfiguration('uniqId', '') == $uniqId ) {
                $return[] = $abeillesWithUniqId;
            }
        }

        return $return;
    }

    /**
     * Will return the json file name for a template uniqId
     *
     * @return          Return the json file name for a template uniqId or -1 if not found
     */
    public static function getJsonFileNameForUniqId( $uniqId ) {
        $templateFiles = glob('/var/www/html/plugins/Abeille/core/config/devices/*/*.json'); 
        foreach( $templateFiles as $templateFile ) {
            $json = file_get_contents( $templateFile );
            if ( strpos($json, $uniqId) > 1 ) {
                return $templateFile;
            }
        }
        return -1;
    }

    /**
     * Will return the json array for a template uniqId
     *
     * @return          Return the json array for a template uniqId or -1 if not found
     */
    public static function getJsonForUniqId( $uniqId ) {
        $jsonText = file_get_contents( self::getJsonFileNameForUniqId( $uniqId ));
        $jsonArray = json_decode($jsonText, true);
        return $jsonArray;
    }

    /**
     * Will return the name o fthe device store n the template
     *
     * @return          Return the name o fthe device store n the template
     */
    public static function getNameJeedomFromTemplate( $uniqId ) {
        $jsonArray = self::getJsonForUniqId( $uniqId );
        foreach ( $jsonArray as $key=>$data ) {
            return $jsonArray[$key]["nameJeedom"];
        }
    }

    /**
     * Will return the timeout for the device stored in the template
     *
     * @return          Return return the timeout for the device stored in the template
     */
    public static function getTimeOutFromTemplate( $uniqId ) {
        $jsonArray = self::getJsonForUniqId( $uniqId );
        foreach ( $jsonArray as $key=>$data ) {
            return $jsonArray[$key]["timeout"];
        }
    }

    /*
    * Will return the categories for the device stored in the template
    *
    * @return          Return return the categories (array) for the device stored in the template
    */
   public static function getCategorieFromTemplate( $uniqId ) {
       $jsonArray = self::getJsonForUniqId( $uniqId );
       foreach ( $jsonArray as $key=>$data ) {
           return $jsonArray[$key]["Categorie"];
       }
   }

    /*
    * Will return the configuration for the device stored in the template
    *
    * @return          Return return the configuration item for the device stored in the template if exist otherwise ''
    */
    public static function getConfigurationFromTemplate( $uniqId, $item ) {
        $jsonArray = self::getJsonForUniqId( $uniqId );
        foreach ( $jsonArray as $key=>$data ) {
            if (isset($jsonArray[$key]["configuration"][$item])) {
                return $jsonArray[$key]["configuration"][$item];
            }
            else {
                return '';
            }
            
        }
    }

    /*
    * Will return the Commandes for the device stored in the template
    *
    * @return          Return return the Commandes (array) for the device stored in the template
    */
    public static function getCommandesFromTemplate( $uniqId ) {
        $jsonArray = self::getJsonForUniqId( $uniqId );
        foreach ( $jsonArray as $key=>$data ) {
            return $jsonArray[$key]["Commandes"];
        }
    }
    

}

?>
