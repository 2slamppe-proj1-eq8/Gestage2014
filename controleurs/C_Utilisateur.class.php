<?php

class C_Utilisateur extends C_ControleurGenerique {

    /**
     * préparation et affichage des coordonnées de l'utilisateur courant
     */
    function coordonnees() {
        $this->vue = new V_Vue("../vues/templates/template.inc.php");
        $this->vue->ecrireDonnee('titreVue', 'Vos informations');
        // charger les coordonnées de l'utilisateur connecté depuis la BDD       
        $daoPers = new M_DaoPersonne();
        $daoPers->connecter();
        $utilisateur = $daoPers->getOneByLogin(MaSession::get('login'));
        $daoPers->deconnecter();
        $this->vue->ecrireDonnee('utilisateur', $utilisateur);
        // transmettre le login        
        $this->vue->ecrireDonnee('loginAuthentification', MaSession::get('login'));
        // vue centrale à inclure
        $this->vue->ecrireDonnee('centre', "../vues/includes/utilisateur/centreAfficherMesInformationsFormulaire.inc.php");
        $this->vue->afficher();
    }

    /**
     *  modification des coordonnées de l'utilisateur courant
     */
    function modifierCoordonnees() {
        $this->vue = new V_Vue("../vues/templates/template.inc.php");
        $this->vue->ecrireDonnee('titreVue', 'Modification de vos informations');
        // charger les coordonnées de l'utilisateur connecté depuis la BDD       
        $daoPers = new M_DaoPersonne();
        $daoPers->connecter();
        $utilisateur = $daoPers->getOneByLogin(MaSession::get('login'));
        $daoPers->deconnecter();
        $this->vue->ecrireDonnee('utilisateur', $utilisateur);
        // transmettre le login        
        $this->vue->ecrireDonnee('loginAuthentification', MaSession::get('login'));

        $this->vue->ecrireDonnee('centre', "../vues/includes/utilisateur/centreModifierMesInformationsFormulaire.inc.php");
        $this->vue->afficher();
    }

    //validation de modification des donnée personelle à l'utilisateur
    function validerModifierCoordonnees() {
        $this->vue = new V_Vue("../vues/templates/template.inc.php");
        $this->vue->ecrireDonnee('titreVue', "Modification de vos informations");
        $this->vue->ecrireDonnee('centre',"../vues/includes/utilisateur/centreValiderModifierMesInformations.inc.php");
        $daoPers = new M_DaoPersonne();
        
        $daoPers->connecter();
         
        // récupérer les données du formulaire l'identifiant de l'utilisateur courant
        $id = $_GET["id"];

        // charger l'objet métier correspondant à l'utilisateur courant
//        $utilisateur = $daoPers->getOneByLoginEager($id);
        $utilisateur = $daoPers->getOneById($id);
//        var_dump($utilisateur);
        // mettre à jour l'objet métier d'après le formilaire de saisie
        $utilisateur->setCivilite($_POST["civilite"]);
        $utilisateur->setNom($_POST["nom"]);
        $utilisateur->setPrenom($_POST["prenom"]);
        $utilisateur->setNumTel($_POST["tel"]);
        $utilisateur->setMail($_POST["mail"]);
        if (MaSession::get('role') == 4) {
            $utilisateur->setEtudes($_POST["etudes"]);
            $utilisateur->setFormation($_POST["formation"]);
        }
        $ok = $daoPers->update($id, $utilisateur);
        if ($ok) {
            $this->vue->ecrireDonnee('message',"Modifications enregistr&eacute;es");
        } else {
            $this->vue->ecrireDonnee('message',"Echec des modifications");
        }
        $this->vue->afficher();
    }
    
    function ajoutStage($message=" ")
    {
        $daoPers = New M_DaoPersonne();
        $daoPers->connecter();
        $pdo = $daoPers->getPdo();
        $rows = array('nom','prenom') ;
        $etudiant = $daoPers->getAllByRole($rows, 4) ;
        $prof = $daoPers->getAllByRole($rows, 3) ;

        $classe= New M_DaoClass ;
        
        $classe->setPdo($pdo);
        
        $orga = New M_DaoOrganisation ;
        $orga->setPdo($pdo);
        $orgas = $orga->getAll() ;
    

      
        
   
  
        //VUE
        $fichier = "../vues/templates/template.inc.php" ;
        $centre = "../vues/includes/utilisateur/centreAjoutStage.php" ;
        $titre = 'Ajouter un stage' ;

        $this->vue = new V_Vue($fichier) ;
        $this->vue = new V_Vue($fichier) ;
        $this->vue->ecrireDonnee('listeClasse', $classe->getAll());
        $this->vue->ecrireDonnee('listeNoms', $etudiant);
        $this->vue->ecrireDonnee('listeProf', $prof) ;
        $this->vue->ecrireDonnee('listeOrgas', $orgas) ;
        $this->vue->ecrireDonnee('message', $message) ;
        $this->vue->ecrireDonnee('gauche', '../vues/templates/gauche.inc.php') ;
        $this->vue->ecrireDonnee('titreVue', $titre) ;
        $this->vue->ecrireDonnee('centre',"../vues/includes/utilisateur/centreAjoutStage.php");
        $this->vue->ecrireDonnee('loginAuthentification',MaSession::get('login')); 
        $this->vue->afficher() ;
        
        //Mémoriser les personnes
        
     
        
    
    }
    
    function validationAjoutStage()
    {
   
        $daoPers = New M_DaoPersonne();
        $daoPers->connecter();
        $pdo = $daoPers->getPdo();
        
        //Verif Maître de stage
        $nom = $_POST['nomMaster'];
        $prenom = $_POST['prenomMaster'];
        
        $verifMaster = $daoPers->getOnByName($nom, $prenom) ;
        //Verification que le maître de stage existe
        if(!empty($verifMaster))
        {
            //RECUPERATION DE L'ID DU MAITRE DE STAGE
            $idMaster=$daoPers->getIdPers($nom,$prenom) ;
            $idMaster = intval($idMaster['IDPERSONNE']) ;
           
               
            //RECUPERATION DE L'ID DE L'ETUDIANT
             $nomEtudiant =$_POST['nomEtudiant'] ;
             $prenomEtudiant = $_POST['prenomEtudiant'] ;
             $idEtudiant = $daoPers->getIdPers($nomEtudiant, $prenomEtudiant) ;
             
             if($idEtudiant) 
             {
                    $idEtudiant = intval($idEtudiant['IDPERSONNE']);
                    //RECUPERATION DE L'ID DU PROFESSEUR
                    $nomProf =$_POST['nomProf'] ;
                    $prenomProf = $_POST['prenomProf'] ;
                    $idProf = $daoPers->getIdPers($nomProf, $prenomProf) ;
                    if($idProf)
                    {
                    $idProf = intval($idProf['IDPERSONNE']) ;

                    //Instanciation du stage

                    $stage = new M_DaoStage() ;

                    //INITIALISATION DES VARIABLES

                   $classe= $_POST['classe'] ;
                   $anneScol= $_POST['anneeScol'] ;
                   $idOrga= intval($_POST['nomOrgas']) ;
                   $dateDebut= $_POST['dateDebut'] ;
                   $dateFin= $_POST['dateFin'] ;
                   $dateVisite= $_POST['dateVisite'] ;
                   $ville= $_POST['ville'] ;


                    //TRANSFORMATION DES DATES AU FORMAT DATE DE MYSQL
                    $dateDebut= splitDate($dateDebut) ;
                    $dateFin= splitDate($dateFin) ;  
                    $dateVisite= splitDate($dateVisite) ;
                    
                    if($idOrga != -1)
                    { 
                    //COMPARAISON DES DATES
                    $ok = 1 ;
                    
                    if($dateFin < $dateDebut)
                    {
                        $message = "La date de fin de stage doit être superieur à la date du début" ;
                        $ok = 0 ;
                    }
                    
                  
                    if(($dateVisite < $dateDebut) && ($dateVisite > $dateFin)) 
                    {
                        $message = "La date de visite doit se trouver entre la date du début et la date de fin" ;
                        $ok = 0 ;
                    }
                    
                    //Si les dates correspondent on envoie
                    
                    if ($ok == 1) 
                    {
                    
                        //Initialisation du pdo
                       $stage->connecter() ;
                       $stage->getPdo() ;
                       
                       //Creation de l'objet stage
                       $Unstage = new M_Stage(null,$anneScol,$idEtudiant,$idProf,$idOrga,$idMaster,$dateDebut,$dateFin,$dateVisite,$ville);

                       //Insertion dans la base de donnée
                       if($stage->insert($Unstage)=='true')
                       {
                          $message = "Le stage à bien été enregisté" ;

                       }

                       else 
                       {
                          $message = "Une erreur inconnue s'est produite" ;
                       }
                    } else
                    {
                        $message = $message ;
                    }
                    }else
                    {
                        $message="Le nom de l'entreprise doit être remplis" ;
                    }
                   } else
                   {
                       $message ="Le nom et le prenom du professeur ne correspondent pas" ;
                   }
                   
             } else
             {
                 $message = "Le nom et prenom de l'étudiant ne correspondent pas" ;
             }
           }else
           {
            $message = "Le maître de stage n'est pas présent dans nos données, Veuillez l'ajouter." ;
        }
   
         $this->ajoutStage($message) ;
               
    }
   
}
   
   
 ?>
