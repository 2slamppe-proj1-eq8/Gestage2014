<script language="JavaScript" type="text/javascript" src="../vues/javascript/fonctionsJavascript.inc.js"></script>
<script language="JavaScript" type="text/javascript" src="../bibliotheques/jquery.js"></script>
<script language="JavaScript" type="text/javascript" src=".../vues/javascript/ajax.inc.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

<h2 style="text-align: center ;"> Ajout d'un stage</h2>

<?php 
echo '<p class="mess-error">'.$this->lireDonnee('message').'</p>' ;
?>
<h3>Etudiant</h3>
<hr>
<br/>
<form method="post" action=".?controleur=Utilisateur&action=validationAjoutStage" name="CreateInterShipo">
    <p>
    <label>Classe</label>
    <select name="classe" id="classe">
        <option value=" "></option>
        
          <?php
    
            // remplissage du "SELECT" qui contien les roles
          
            foreach ($this->lireDonnee('listeClasse') as $classe) {
             
              
                echo'<option value="' . $classe->getNumClass() . '">' . $classe->getNumClass() . '</option>';
            }
            ?>  
         </select>
            <label> Annee scolaire</label>
            <input type="text" name="anneeScol" id="anneeScol">
        
    </select>
    </p>
    <p>
    <label>Nom de l'étudiant</label>
     <select  name="nomEtudiant" id="nomEtud"><!-- le OnChange éxécute la fonction qui affichera ou non le formulaire etudiant -->
            <option value=""></option>

                 <?php  
            
       for ($i = 0 ; $i < sizeof($this->lireDonnee('listeNoms')) ; $i++)
            {
         
                foreach($this->lireDonnee('listeNoms') as $nom) 
                {
                echo'<option value="' . $nom[1] . '">' . $nom[1] . '</option>';
                }
            }
    
    
            
            ?>  
        </select>
    
    </p>
    <p>
    <label>Prenom de l'étudiant</label>
     <select  name="prenomEtudiant" id="prenomEtud"><!-- le OnChange éxécute la fonction qui affichera ou non le formulaire etudiant -->
            <option value=""></option>
            <?php  
            
       for ($i = 0 ; $i < sizeof($this->lireDonnee('listeNoms')) ; $i++)
            {
         
                foreach($this->lireDonnee('listeNoms') as $nom) 
                {
                echo'<option value="' . $nom[2] . '">' . $nom[2] . '</option>';
                }
            }
    
    
            
            ?>  
             </select>
    </p>
  
            <label>Nom du professeur responsable de l'étudiant</label>
     <select  name="nomProf" id="nomProf"><!-- le OnChange éxécute la fonction qui affichera ou non le formulaire etudiant -->
            <option value=""></option>
            <?php  
            
       for ($i = 0 ; $i < sizeof($this->lireDonnee('listeProf')) ; $i++)
            {
         
                foreach($this->lireDonnee('listeProf') as $nom) 
                {
                echo'<option value="' . $nom[1] . '">' . $nom[1] . '</option>';
                }
            }
    
    
            
            ?>  
             </select>
            <label>Prenom du professeur responsable de l'étudiant</label>
     <select  name="prenomProf" id="prenomProf"><!-- le OnChange éxécute la fonction qui affichera ou non le formulaire etudiant -->
            <option value=""></option>
            <?php  
            
       for ($i = 0 ; $i < sizeof($this->lireDonnee('listeProf')) ; $i++)
            {
         
                foreach($this->lireDonnee('listeProf') as $nom) 
                {
                echo'<option value="' . $nom[2] . '">' . $nom[2] . '</option>';
                }
            }
    
    
            
            ?>  
             </select>
            
            <label> Nom du maître de stage </label>
            <input type="text" name="nomMaster" id="nomMaster" />
            
            <label> Prénom du maître de stage </label>
            <input type="text" name="prenomMaster" id="prenomMaster" />
            
            <label> Nom de l'entreprise</label>
       
             
           <select  name="nomOrgas" id="nomOrgas"><!-- le OnChange éxécute la fonction qui affichera ou non le formulaire etudiant -->
            <option value="" id=""></option>
            <?php  
            
     
         
                foreach($this->lireDonnee('listeOrgas') as $nom) 
                {
                echo'<option value="' . $nom->getIdorganisation(). '">' . $nom->getNom_organisation() . '</option>';
                }
           
    
   
            ?>  
            </select>
            <label> Date de début</label>
            <input type="date" name="dateDebut"class="date" id="dateDebut"/>
            <label> date de fin </label>
            <input type="date" name="dateFin" class="date" id="dateFin"/>
            
            <label> Date visite de stage </label>
            <input type="date" name="dateVisite" class="date" id="dateVisit">
            
            <label> Ville </label>
            <input type="text" name="ville" id="Ville" />
           
            <label></label><input type="submit" value="Valider" onclick="return validerStage()" />
</form>

 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
        $( ".date" ).datepicker();
  });
  </script>