

<script language="JavaScript" type="text/javascript" src="../vues/javascript/fonctionsJavascript.inc.js"></script>
<script language="JavaScript" type="text/javascript" src="../bibliotheques/jquery.js"></script>
<script language="JavaScript" type="text/javascript" src=".../vues/javascript/ajax.inc.js"></script>


<?php


 ?>
<h2> Ajout d'une entrerpise</h2>
<hr>
<!-- VARIABLES NECESSAIRES -->

<!-- $this->message : à afficher sous le formulaire -->
<form method="post" action=".?controleur=Utilisateur&action=validationAjoutEntreprise" name="CreateInterShipo">
   
   <fieldset>
        <legend>Ses informations g&eacute;n&eacute;rales</legend>
        <input type="hidden" readonly="readonly" name="id" id="id"></input>
        <label for="civilite">Civilit&eacute; :</label>

        <select type="select" name="civilite" id="civilite">
            <option>Madame</option>
            <option>Monsieur</option>
        </select>
        <label for="nomOrg">Nom Organisation :</label>
        <input type="text" name="nomOrg" id="nom"></input><br/>
        <label for="AdresseOrg">Adresse Organisation :</label>
        <input type="text" name="AdresseOrg" id="prenom"></input><br/>
        <label for="mailOrg"> E-Mail :</label>
        <input type="text" name="mailOrg" id="mail"></input><br/>
        <label for="tel">Tel :</label>
        <input type="text" name="tel" id="tel"></input><br/>
        <label for="tel">Tel portable:</label>
        <input type="text" name="telP" id="telP"></input><br/>
    </fieldset>
</form>

<fieldset>
        <input type="submit" value="Creer" onclick="return valider()"></input><!-- OnClick éxécutera le JS qui testera tout les champ du formulaire. -->
        <input type="button" value="Retour" onclick="history.go(-1)">
    </fieldset>
</form>
<?php
// message de validation de création ou non 
if (isset($this->message)) {
    echo "<strong>" . $this->message . "</strong>";
}
?>

