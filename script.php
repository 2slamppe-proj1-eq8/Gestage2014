<?php
// configuration
$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "gestage";
$dbuser		= "root";
$dbpass		= "joliverie";

// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);


$listePrenom=array('MAEL','DAVID','FLORIAN','JEREMY','EMILIE','PIERRE','BENJAMIN','MAXIME','LOIC','THOMAS','AURELIEN','FLORIAN','PIERRE','STANISLAS','LAURENT','STEPHANE','YANNIS','THIBAULT','JULIEN','VALENTIN','ANTOINE','TANGUY','ANTOINE') ;
$listeNom=array('ANDRE','BONNET','BRETIN','BROYARD','CHANSON','CHARRIAU','CORBINEAU','COUTEAU','DESIREST','DION','DROUAUD','DURIEUX','FRENEAU','LEDUC','LEPEE','LOISEAU','MACHOURI','PERROIN','REDOR','RIO','SAINDRENAN','THIBEAU','TOUCHARD') ;

for ($i = 0; $i <= 22; $i++) {
      $mail = strtolower(ucfirst($listePrenom[$i]).$listeNom[$i].'@mail.fr') ;
      $pseudo =  strtolower(ucfirst($listePrenom[$i]).$listeNom[$i] ) ;
      $mdp = sha1(strtolower(ucfirst($listePrenom[$i]).$listeNom[$i] )) ;
    if($i%2==0){
        
      
       
        
        $sql= "INSERT INTO `PERSONNE` (
        `IDPERSONNE`,
        `IDSPECIALITE`,
        `IDROLE`,
        `CIVILITE`,
        `NOM`,
        `PRENOM`,
        `NUM_TEL`,
        `ADRESSE_MAIL`,
        `NUM_TEL_MOBILE`,
        `ETUDES`,
        `FORMATION`,
        `LOGINUTILISATEUR`,
        `MDPUTILISATEUR`) 
  VALUES(NULL, 2, '4', 'Monsieur', '".$listeNom[$i]."', '".$listePrenom[$i]."','0".rand(000000000, 999999999)."', '".$mail."', '06".rand(00000000, 99999999)."', 'BTS', 'SIO', '".$pseudo."', '".$mdp."') ;";
    }
    else{
        $sql= "INSERT INTO `PERSONNE` (
        `IDPERSONNE`,
        `IDSPECIALITE`,
        `IDROLE`,
        `CIVILITE`,
        `NOM`,
        `PRENOM`,
        `NUM_TEL`,
        `ADRESSE_MAIL`,
        `NUM_TEL_MOBILE`,
        `ETUDES`,
        `FORMATION`,
        `LOGINUTILISATEUR`,
        `MDPUTILISATEUR`) 
       VALUES(NULL, 2, '4', 'Madame', '".$listeNom[$i]."', '".$listePrenom[$i]."','0".rand(000000000, 999999999)."', '".$mail."', '06".rand(00000000, 99999999)."', 'BTS', 'SIO', '".$pseudo."', '".$mdp."') ;";
    }
    
 
    
    echo $sql;
    echo "<br>";
}





?>