<!-- FORMULAIRE D INSCRIPTION -->

<?php

?>
<!-- Image d'un chat -->
<img src="public/img/chat.webp" alt="regard d'un chat" class="chat-image">

<!-- Titre de la page -->
<h1>S'inscrire</h1>

<!-- DEBUT DU FORMULAIRE D INSCRIPTION -->
<!--STRUCTURE DE L'URL POUR DECLENCHER UNE ACTION: INDEX.PHP?CTRL ACTION= METHOD= ID= -->
<form action="index.php?ctrl=security&action=register" method="POST" class="register-form">
    <!-- Champ pour le pseudo -->
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" required><br>

     <!-- Champ pour l'email -->
    <label for="email">Mail</label>
    <input type="email" name="email" id="email" required><br>

    <!-- Champ pour le mot de passe avec des exigences -->
    <label for="pass1">Mot de passe <small class="password-hint">(Au moins 12 caractères, dont 1 lettre majuscule, 1 lettre minuscule et 1 chiffre)</small></label>
    <input type="password" name="pass1" id="pass1" required><br>

    <!-- Champ pour la confirmation du mot de passe -->
    <label for="pass2">Confirmation du mot de passe</label>
    <input type="password" name="pass2" id="pass2"  required><br>

     <!-- Case à cocher pour le consentement à la politique de confidentialité -->
    <label for="consentement" class="consentement-label">
        <input type="checkbox" name="consentement" id="consentement"  required>
        <a href="index.php?ctrl=location&action=mentionsLegales"> J'accepte que mes informations personnelles soient utilisées 
    conformément à la politique de confidentialité.</a>
    </label><br>

    <!-- ReCAPTCHA pour valider que l'inscription est effectuée par un humain -->
    <div class="g-recaptcha" data-sitekey="6LeUhkYqAAAAALeAYNXSofNNSW3Fw9vzIRzl4Ngw" data-action="LOGIN" required></div>
<br/>
    <!-- Conteneur pour le bouton de soumission -->
    <div class="submit-container">
        <input type="submit" name="submitRegister" value="S'enregistrer">
    </div>
</form>
<!-- Chargement du script ReCAPTCHA de Google pour la validation -->
<script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>