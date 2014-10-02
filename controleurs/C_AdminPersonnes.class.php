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
       
      //INITIALISATION DE LA PERSONNE
      $daoPers = new M_DaoPersonne();
      $daoPers->connecter();
   
      //INITIALISATION DES VARIABLES
    
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
      $login= $_POST['login'] ;
      $mdp= sha1($_POST['mdp']) ;
      
     
     
      //INSTANCIATION DU ROLE,SPECIALITE ET DE LA PERSONNE
      $newRole=New M_Role($role, null,null) ;
      $newSpec=New M_Specialite($option, null, null) ;
      $pers = new M_Personne(null,$newSpec,$newRole,$civilite,$nom,$prenom,$tel,$mail,$portable,$etudes,$formation,$login,$mdp);
    
      
      //VERIFICATION DU MAIL ET DU LOGIN
      $verif=$daoPers->verif('adresse_mail','loginutilisateur',$mail, $login) ;
    
   
       $daoPers->getPdo() ;
   
       //SI LE MAIL ET LE LOGIN N'EXISTE PAS, CREATION DE LA PERSONNE
       if ($verif['ok'] !=0)
       {
        if ($daoPers->insert($pers) == true )
        {
            header('Location: http://localhost/sites/Gestage2014/public');
        }  
       }
       else 
       {
           echo $verif['message'] ; 
       }
     
    }
}
    

