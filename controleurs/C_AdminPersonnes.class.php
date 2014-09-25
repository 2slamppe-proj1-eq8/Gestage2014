 <?php


/**
 * Description of C_AdminPersonnes
 * CRUD Personnes
 * @author btssio
 */
class C_AdminPersonnes extends C_ControleurGenerique {
    // Fonction d'affichage du formulaire de création d'une personne
    function creerPersonne(){
        $this->vue = new V_Vue("../vues/templates/template.inc.php");
        $this->vue->ecrireDonnee('titreVue', 'Cr&eacute;ation d\'une personne');
        // ... depuis la BDD       
        $daoPers = new M_DaoPersonne();
        $daoPers->connecter();
        $pdo = $daoPers->getPdo();
       
        // Mémoriser la liste des spécialités disponibles
        $daoSpecialite = new M_DaoSpecialite();
        $daoSpecialite->setPdo($pdo);
        $this->vue->ecrireDonnee('lesSpecialites', $daoSpecialite->getAll());
               
        // Mémoriser la liste des rôles disponibles
        $daoRole = new M_DaoRole();
        $daoRole->setPdo($pdo);
        $this->vue->ecrireDonnee('lesRoles', $daoRole->getAll());
        
        $this->vue->ecrireDonnee('loginAuthentification',MaSession::get('login'));       
        $this->vue->ecrireDonnee('centre', "../vues/includes/adminPersonnes/centreCreerPersonne.inc.php");
               
        $this->vue->afficher();
    }
    
    //validation de création d'utilisateur 
    function validationcreerPersonne(){
        /*Modification, instanciation de la vue */
        $this->vue = new V_Vue("../vues/templates/template.inc.php") ;
        $daoPers = new M_DaoPersonne();
        $daoPers->connecter();
       
       
    
      $id= $_POST['id'] ;
      $option= $_POST['option'] ;
      $role= $_POST['role'] ;
      $civilite= $_POST['civilite'] ;
      $nom= $_POST['nom'] ;
      $prenom= $_POST['prenom'] ;
      $tel= $_POST['tel'] ;
      $portable= $_POST['telP'] ;
      $mail= $_POST['mail'] ;
      $etudes= $_POST['etudes'] ;
      $formation= $_POST['formation'] ;
      $login= $_POST['id'] ;
      $mdp= $_POST['mdp'] ;
      
       $newRole=New M_DaoRole($role, null,null) ;
       $role = $newRole -> objetVersEnregistrement($role) ;
       var_dump($role) ; die() ;

       $pers = new M_Personne($id,$option,$role,$civilite,$nom,$prenom,$tel,$mail,$portable,$etudes,$formation,$login,$mdp);
        //$pers=$daoPers->objetVersEnregistrement($pers);
         //$daoPers ->insert($pers) ;
        var_dump($pers) ;
        die() ;
 
         
        $this->vue->afficher();
    }
    
}
