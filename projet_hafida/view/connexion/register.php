<?php

?>
<img src="public\img\chat.png" alt="regard d'un chat" style="width: 100%; height: auto; object-fit: contain;">
<h1>S'inscrire</h1>

<form action="index.php?ctrl=security&action=register" method="POST"><!--STRUCTURE DE L'URL POUR DECLENCHER UNE ACTION: INDEX.PHP?CTRL ACTION= METHOD= ID= -->
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo"><br>

    <label for="email">Mail</label>
    <input type="email" name="email" id="email"><br>

    <label for="pass1">Mot de passe</label>
    <input type="password" name="pass1" id="pass1"><br>

    <label for="pass2">Confirmation du mot de passe</label>
    <input type="password" name="pass2" id="pass2"><br>

    <label for="consentement">
        <input type="checkbox" name="consentement" id="consentement">
        <a href="index.php?ctrl=location&action=mentionsLegales">J'accepte que mes informations personnelles soient utilisées 
        conformément à la politique de confidentialité.</a>
    </label><br>

        
    <div class="submit-container">
        <input type="submit" name="submitRegister" value="S'enregistrer">
    </div>


</form>
   