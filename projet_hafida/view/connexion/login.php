
<!-- FORMULAIRE DE CONNEXION -->

<?php

?>
<!-- Image d'un chat avec un texte alternatif -->
<img src="public/img/chat.webp" alt="regard d'un chat" class="chat-image">

<div class="login-container">
<h1>Se connecter</h1> <!-- Titre du formulaire de connexion -->

<!-- Formulaire de connexion -->
<form id="loginForm" action="index.php?ctrl=security&action=login" method="post" onsubmit="return validateRecaptcha();">
<!-- Champ pour l'email -->
<label for="email">Email</label>
<input type="email" name="email" id="email" value="lea@exemple.com" required><br>

<!-- Champ pour le mot de passe -->
<label for="password">Mot de passe</label>
<input type="password" name="password" id="password" value="Azerty123456" required><br>

<!-- Widget reCAPTCHA de Google pour la vérification humaine -->
<div class="login-container">
<div class="recaptcha" id="recaptcha-container">
<div class="g-recaptcha" data-sitekey="6LeUhkYqAAAAALeAYNXSofNNSW3Fw9vzIRzl4Ngw" data-action="LOGIN"></div>
<br/>
<!-- Bouton de soumission du formulaire -->
<input type="submit" name="submitLogin" value="Se connecter">
<script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>


<!-- Lien vers la vue forgotPassword -->
<p><a href="index.php?ctrl=security&action=forgotPassword">Mot de passe oublié ?</a></p>

</form>
</div>

