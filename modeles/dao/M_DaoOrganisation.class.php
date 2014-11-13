<?php

class M_DaoOrganisation extends M_DaoGenerique

{
     function __construct() {
        $this->nomTable = "ORGANISATION";
        $this->nomClefPrimaire = "IDORGANISATION";
    }
    
    public function enregistrementVersObjet($enreg) {
 $retour = new M_Organisation(
         $enreg['IDORGANISATION'], 
         $enreg['NOM_ORGANISATION'], 
         $enreg['VILLE_ORGANISATION'],  
         $enreg['ADRESSE_ORGANISATION'],
         $enreg['CP_ORGANISATION'],
         $enreg['TEL_ORGANISATION'],
         $enreg['FAX_ORGANISATION'],
         $enreg['FORMEJURIDIQUE'],
         $enreg['ACTIVITE']
         );
        return $retour;
    }

    public function insert($objetMetier) {
          
        
    }

    public function objetVersEnregistrement($objetMetier) {
          $retour = array(
            ':idorganisation' => $objetMetier->getNumClass(),
            ':idSpec' => $objetMetier->getIdSpec(),
            ':numFiliere' => $objetMetier->getNumFIliere(),
            ':nomClass' => $objetMetier->getNomClasse()
        );
        return $retour;
    }

    public function update($idMetier, $objetMetier) {
        
    }
       function getAll() {
  
        $retour = null;
        // Requête textuelle
        $sql = "SELECT * FROM $this->nomTable P ";
     
        try {
            // préparer la requête PDO
          
            $queryPrepare = $this->pdo->prepare($sql);
            // exécuter la requête PDO
            if ($queryPrepare->execute()) {
                // si la requête réussit :
                // initialiser le tableau d'objets à retourner
                $retour = array();
                // pour chaque enregistrement retourné par la requête
                while ($enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC)) {
                    // construir un objet métier correspondant
                    $unObjetMetier = $this->enregistrementVersObjet($enregistrement);
                    // ajouter l'objet au tableau
                    $retour[] = $unObjetMetier;
                }
            }
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
       
        return $retour;
       
    }

}