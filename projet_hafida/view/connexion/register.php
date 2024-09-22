<?php

?>
<img src="public/img/chat.webp" alt="regard d'un chat" class="chat-image">

<h1>S'inscrire</h1>

<form action="index.php?ctrl=security&action=register" method="POST"><!--STRUCTURE DE L'URL POUR DECLENCHER UNE ACTION: INDEX.PHP?CTRL ACTION= METHOD= ID= -->
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" required><br>

    <label for="email">Mail</label>
    <input type="email" name="email" id="email" required><br>

    <label for="pass1">Mot de passe <small class="password-hint">(Au moins 12 caractères, dont 1 lettre majuscule, 1 lettre minuscule et 1 chiffre)</small></label>
    <input type="password" name="pass1" id="pass1" required><br>

    <label for="pass2">Confirmation du mot de passe</label>
    <input type="password" name="pass2" id="pass2"  required><br>

    <label for="consentement">
        <input type="checkbox" name="consentement" id="consentement"  required>
        <a href="index.php?ctrl=location&action=mentionsLegales">J'accepte que mes informations personnelles soient utilisées 
        conformément à la politique de confidentialité.</a>
    </label><br>

    <div class="g-recaptcha" data-sitekey="6LeUhkYqAAAAALeAYNXSofNNSW3Fw9vzIRzl4Ngw" data-action="LOGIN" required></div>
<br/>
    <div class="submit-container">
        <input type="submit" name="submitRegister" value="S'enregistrer">
    </div>
</form>
<script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>