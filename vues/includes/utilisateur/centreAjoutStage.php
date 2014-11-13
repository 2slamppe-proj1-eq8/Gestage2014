<script language="JavaScript" type="text/javascript" src="../vues/javascript/fonctionsJavascript.inc.js"></script>
<script language="JavaScript" type="text/javascript" src="../bibliotheques/jquery.js"></script>
<script language="JavaScript" type="text/javascript" src=".../vues/javascript/ajax.inc.js"></script>

<?php 


?>
<h2> Ajout d'un stage</h2>
<hr>
<!-- VARIABLES NECESSAIRES -->

<!-- $this->message : à afficher sous le formulaire -->
<form method="post" action=".?controleur=Utilisateur&action=validationAjoutStage" name="CreateInterShipo">
    
    <label>Classe</label>
    <select name="classe">
        <option value=""></option>
        
          <?php
    
            // remplissage du "SELECT" qui contien les roles
           
            foreach ($this->lireDonnee('listeClasse') as $classe) {
             
              
                echo'<option value="' . $classe->getNumClass() . '">' . $classe->getNumClass() . '</option>';
            }
            ?>  
        
        
    </select>
    <label>Nom</label>
     <select  name="nom" id="nom"><!-- le OnChange éxécute la fonction qui affichera ou non le formulaire etudiant -->
            <option value=""></option>

            <?php
              foreach ($this->lireDonnee('listeNoms') as $nom) {
                
              
                echo'<option value="' . $nom->getId() . '">' . $nom->getNom() . '</option>';
            }
            ?>  
            
            ?>  
        </select>
      <?php
              foreach ($this->lireDonnee('listeNoms') as $nom) {
                
              var_dump($nom) ;
               
            }
            ?>  
    <label>Prenom</label>
   
</form>