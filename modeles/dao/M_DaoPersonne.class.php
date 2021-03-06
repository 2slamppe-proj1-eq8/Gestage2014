l<?php

class M_DaoPersonne extends M_DaoGenerique {

    function __construct() {
        $this->nomTable = "PERSONNE";
        $this->nomClefPrimaire = "IDPERSONNE";
    }

    /**
     * Redéfinition de la méthode abstraite de M_DaoGenerique
     * Permet d'instancier un objet d'après les valeurs d'un enregistrement lu dans la base de données
     * @param tableau-associatif $unEnregistrement liste des valeurs des champs d'un enregistrement
     * @return objet :  instance de la classe métier, initialisée d'après les valeurs de l'enregistrement 
     */
    public function enregistrementVersObjet($enreg) {
        // on instancie les objets Role et Specialite s'il y a lieu
        $leRole = null;
        if (isset($enreg['LIBELLE'])) {
            $daoRole = new M_DaoRole();
            $daoRole->setPdo($this->pdo);
            $leRole = $daoRole->getOneById($enreg['IDROLE']);
        }
        $laSpecialite = null;
        if (isset($enreg['LIBELLELONGSPECIALITE'])) {
            $daoSpe = new M_DaoSpecialite();
            $daoSpe->setPdo($this->pdo);
            $laSpecialite = $daoSpe->getOneById($enreg['IDSPECIALITE']);
        }
        // on construit l'objet Personne 
        $retour = new M_Personne(
                $enreg['IDPERSONNE'], $laSpecialite, $leRole, $enreg['CIVILITE'], $enreg['NOM'], $enreg['PRENOM'], $enreg['NUM_TEL'], $enreg['ADRESSE_MAIL'], $enreg['NUM_TEL_MOBILE'], $enreg['ETUDES'], $enreg['FORMATION'], $enreg['LOGINUTILISATEUR'], $enreg['MDPUTILISATEUR']
        );
        return $retour;
    }
  

    /**
     * Prépare une liste de paramètres pour une requête SQL UPDATE ou INSERT
     * @param Object $objetMetier
     * @return array : tableau ordonné de valeurs
     */
    public function objetVersEnregistrement($objetMetier) {
        // construire un tableau des paramètres d'insertion ou de modification
        // l'ordre des valeurs est important : il correspond à celui des paramètres de la requête SQL
        // le rôle et la spécialité seront mis à jour séparément

        if (!is_null($objetMetier->getRole())) {
            $idRole = $objetMetier->getRole()->getId();
        } else {
            $idRole = 0; // "Autre" (simple visiteur)
        }
        
   if (!is_null($objetMetier->getSpecialite())) {
            $idSpec = $objetMetier->getSpecialite()->getId();
        } else {
            $idSpec = 0; // "Autre" (simple visiteur)
        }
 
       
        $retour = array(
            ':idRole' => $idRole,
            ':specialite' => $idSpec,
            ':civilite' => $objetMetier->getCivilite(),
            ':nom' => $objetMetier->getNom(),
            ':prenom' => $objetMetier->getPrenom(),
            ':numTel' => $objetMetier->getNumTel(),
            ':mail' => $objetMetier->getMail(),
            ':mobile' => $objetMetier->getMobile(),
            ':etudes' => $objetMetier->getEtudes(),
            ':formation' => $objetMetier->getFormation(),
            ':login' => $objetMetier->getLogin(),
            ':mdp' => $objetMetier->getMdp(),
        );
        return $retour;
    }

    /**
     * Lire tous les enregistrements d'une table
     * @return tableau-associatif d'objets : un tableau d'instances de la classe métier
     */
    function getAll() {
       
        $retour = null;
        // Requête textuelle
        $sql = "SELECT * FROM $this->nomTable P ";
        $sql .= "LEFT OUTER JOIN SPECIALITE S ON S.IDSPECIALITE = P.IDSPECIALITE ";
        $sql .= "LEFT OUTER JOIN ROLE R ON R.IDROLE = P.IDROLE ";
        try {
            // préparer la requête PDO
            $queryPrepare = $this->pdo->prepare($sql);
            // exécuter la requête PDO
            // extraire l'enregistrement retourné par la requête
                $enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC);
                // construire l'objet métier correspondant
                $retour = $this->enregistrementVersObjet($enregistrement);
           
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
       
 
;        return $retour;
       
    }

    // eager-fetching
    function getOneById($id) {
        $retour = null;
        try {
            // Requête textuelle
            $sql = "SELECT * FROM $this->nomTable P ";
            $sql .= "LEFT OUTER JOIN SPECIALITE S ON S.IDSPECIALITE = P.IDSPECIALITE ";
            $sql .= "LEFT OUTER JOIN ROLE R ON R.IDROLE = P.IDROLE ";
            $sql .= "WHERE $this->nomClefPrimaire = :id";
            // préparer la requête PDO
            $queryPrepare = $this->pdo->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            if ($queryPrepare->execute(array(':id' => $id))) {
                // si la requête réussit :
                // extraire l'enregistrement retourné par la requête
                $enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC);
                // construire l'objet métier correspondant
                $retour = $this->enregistrementVersObjet($enregistrement);
            }
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }
    
    function getAllByRole($rows,$role)
    {
        
        $retour = null ;
        try
        {
            $sql = "SELECT IDPERSONNE, " ;
            foreach($rows as $v)
            {
                
                $sql .= $v." , ";
               
            }
            $sql = substr($sql, 0, strlen($sql)-2 ) ;
           
           
            $sql .= "FROM $this->nomTable P " ;
 
            $sql .= "WHERE IDROLE = ".$role;   
   
            
 
            $queryPrepare = $this->pdo->prepare($sql);
              if ($queryPrepare->execute()) {
                    $retour =$queryPrepare->fetchAll() ;
                    
                  
           
              }
        } catch (Exception $ex) {

        }
      
        
        return $retour ;
    }
    // eager-fetching
    function getOneByLogin($valeurLogin) {
        $retour = null;
        try {
            // Requête textuelle
            $sql = "SELECT * FROM $this->nomTable P ";
            $sql .= "LEFT OUTER JOIN SPECIALITE S ON S.IDSPECIALITE = P.IDSPECIALITE ";
            $sql .= "LEFT OUTER JOIN ROLE R ON R.IDROLE = P.IDROLE ";
            $sql .= "WHERE P.LOGINUTILISATEUR = ?";
            // préparer la requête PDO
            $queryPrepare = $this->pdo->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            if ($queryPrepare->execute(array($valeurLogin))) {
                // si la requête réussit :
                // extraire l'enregistrement retourné par la requête
                $enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC);
                // construire l'objet métier correspondant
                $retour = $this->enregistrementVersObjet($enregistrement);
            }
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }
    
    function getOnByName($nom,$prenom) {
        $retour = null;
     
        try {
            // Requête textuelle
            $sql = "SELECT nom,prenom FROM $this->nomTable P ";
            $sql .= "WHERE NOM =:nom AND P.prenom=:prenom";
             $stmt = $this->pdo->prepare($sql);
            // préparer la requête PDO
       if ($stmt->execute(array(':nom' => $nom, ':prenom' => $prenom))) {
        
                $retour = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
     
        return $retour;
    }
    function getIdPers($nom, $prenom)
    {
         $retour = null;
     
        try {
            // Requête textuelle
            $sql = "SELECT IDPERSONNE FROM $this->nomTable P ";
            $sql .= "WHERE NOM =:nom AND P.prenom=:prenom";
             $stmt = $this->pdo->prepare($sql);
            // préparer la requête PDO
       if ($stmt->execute(array(':nom' => $nom, ':prenom' => $prenom))) {
        
                $retour = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }

    /**
     * verifierLogin
     * @param string $login
     * @param string $mdp
     * @return boolean 
     */
    function verifierLogin($login, $mdp) {
        $retour = null;
        try {
            $sql = "SELECT * FROM $this->nomTable WHERE LOGINUTILISATEUR=:login AND MDPUTILISATEUR=:mdp";
            $stmt = $this->pdo->prepare($sql);
            if ($stmt->execute(array(':login' => $login, ':mdp' => sha1($mdp)))) {
                $retour = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }

    /**
     * suppression
     * @param type $idMetier
     * @return boolean Cette fonction retourne TRUE en cas de succès ou FALSE si une erreur survient.
     */
    function insert($objetMetier) {
        $retour = FALSE;
        try {
            // Requête textuelle paramétrée (paramètres nommés)
            $sql = "INSERT INTO $this->nomTable (";
            $sql .= "IDSPECIALITE,CIVILITE,IDROLE,NOM,PRENOM,NUM_TEL,ADRESSE_MAIL,NUM_TEL_MOBILE,";
            $sql .= "ETUDES,FORMATION,LOGINUTILISATEUR,MDPUTILISATEUR)  ";
            $sql .= "VALUES (";
            $sql .= ":specialite, :civilite, :idRole, :nom, :prenom, :numTel, :mail, :mobile, ";
            $sql .= ":etudes, :formation, :login, :mdp)";
          
          
            // préparer la requête PDO
            $queryPrepare = $this->pdo->prepare($sql);
         
            // préparer la  liste des paramètres, avec l'identifiant en dernier
            $parametres = $this->objetVersEnregistrement($objetMetier);
        
           
            // exécuter la requête avec les valeurs des paramètres dans un tableau
            $retour = $queryPrepare->execute($parametres);
          
//            debug_query($sql, $parametres);
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }

    function update($idMetier, $objetMetier) {
        $retour = FALSE;
        try {
            // Requête textuelle paramétrée (paramètres nommés)
            $sql = "UPDATE $this->nomTable SET ";
            $sql .= "IDROLE = :idRole , ";
            $sql .= "CIVILITE = :civilite , ";
            $sql .= "NOM = :nom , ";
            $sql .= "PRENOM = :prenom , ";
            $sql .= "NUM_TEL = :numTel , ";
            $sql .= "ADRESSE_MAIL = :mail , ";
            $sql .= "NUM_TEL_MOBILE = :mobile , ";
            $sql .= "ETUDES = :etudes , ";
            $sql .= "FORMATION = :formation , ";
            $sql .= "LOGINUTILISATEUR = :login , ";
            $sql .= "MDPUTILISATEUR = :mdp ";
            $sql .= "WHERE IDPERSONNE = :id";
//            var_dump($sql);
            // préparer la requête PDO
            $queryPrepare = $this->pdo->prepare($sql);
            // préparer la  liste des paramètres la valeur de l'identifiant
            //  à prendre en compte est celle qui a été passée en paramètre à la méthode
            $parametres = $this->objetVersEnregistrement($objetMetier);
            $parametres[':id'] = $idMetier;
            // exécuter la requête avec les valeurs des paramètres dans un tableau
            $retour = $queryPrepare->execute($parametres);
//            debug_query($sql, $parametres);
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour ; 
    }
    
 /**
  * Verif de mail et login lors de la création d'une personne
  * @param type $row1
  * @param type $row2
  * @param type $objet1
  * @param type $objet2
  * @return tableau
  * 
  */
    
    function verif($row1, $row2, $objet1, $objet2) 
    {
        //Initialisation des variables 
        $retour = null ; 
        $message = null ;
        $tab = array('ok'=>1,
                     'message'=>''
            ) ;
        try 
        {
            
            //Requête de la verif de mail
            
           $sql = 'SELECT '.$row1.' FROM '.$this->nomTable.' WHERE '.$row1.'="'.$objet1.'"' ;
           $stmt = $this->pdo->prepare($sql);
         
           $stmt->execute() ;
           $retour = $stmt->fetch(PDO::FETCH_ASSOC);
           if ($retour != false)
           {
  
              $tab['ok'] = 0 ;
              $message= " Erreur : ".$row1." existe déjà" ;
       
               
           }
           
           //Requête de verif de login
           
           $sql2 = 'SELECT '.$row2.' FROM '.$this->nomTable.' WHERE '.$row2.'="'.$objet2.'"' ;
           $stmt2 = $this->pdo->prepare($sql2);
           $stmt2->execute() ;
           $retour = $stmt2->fetch(PDO::FETCH_ASSOC);
            if ($retour != false)
           {
  
              $tab['ok'] = 0 ;
              $message .= " Erreur : ".$row2." existe déjà" ;
               
           }
           if ($tab['ok'] == 0) 
           {
               $tab['message'] = $message ;
           }
        } catch (PDOException $e) 
        {
                echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
 
        return $tab ;
        
    }

}


