<?php
// configuration
$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "gestage";
$dbuser		= "root";
$dbpass		= "joliverie";

// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);


$listeNom=array('ECOLE DES MINES DE NANTES','ALERTE INFORMATIQUE','APS SOLUTIONS INFORMATIQUES','CITRUS INGENIERIE','QUATERNAIRE','PC NEW LIFE','LYCEE NOTRE DAME','MAKINA CORPUS','ATHLONE EXTRUSIONS LTCL','AKOS','TOUANG K.M.','France TELECOM ORANGE','BULL SAS','AGENCE 404','MANITOU BF','REPRO CONSEIL','STRATOS','HG INFORMATIQUE','CAPGEMINI','IBM','HP','BOULANGER','FNAC') ;
$listeAdresse = array('4 RUE ALFRED KASTLER','186 BIS RUE DES COUPERIES', '8 RUE DU MARCHE COMMUN','LIEU DIT LENIPHEN','9 RUE JULES VERNE','1 TER AVENUE DE LA VERTONNE','50 RUE JEAN JAURES','29 QUAI DE VERSAILLES','GRACE ROAD ATHLONE','8 RUE DESCARTES','11 RUE Allemagne','4 RUE ALFRED KASTLER','12 H rue du Pâtis Tatelin - CS 50855','8 BLD ALBERT EINSTEIN','1 RUE SUFFREN','430 RUE DE lAUBINIERE','RUE ST GREGOIRE','14 PLACE DU COMMERCE','ZI DE VILLEJAMES','rue capgeminie','rue de hp','rue de boulanger','rue de la fnac') ;

for ($i = 0; $i <= 22; $i++) {
     
        $sql= "INSERT INTO `ORGANISATION` (
        `IDORGANISATION`,
        `NOM_ORGANISATION`,
        `VILLE_ORGANISATION`,
        `ADRESSE_ORGANISATION`,
        `CP_ORGANISATION`,
        `TEL_ORGANISATION`,
        `FAX_ORGANISATION`,
        `FORMEJURIDIQUE`,
        `ACTIVITE`, 
  VALUES(NULL, '".$listeNom[$i]."', 'Nantes', '".$listeAdresse[$i]."', '44000','0".rand(000000000, 999999999)."', '0".rand(000000000, 999999999)."', 'Developpement' );" ;
    
   
   
 
    
    echo $sql;
    echo "<br>";
}





?>