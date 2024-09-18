<?php

?>

<img src="public\img\chat.png" alt="regard d'un chat" style="width: 100%; height: auto; object-fit: contain;">

<div class="login-container">
<h1>Se connecter</h1>

<form action="index.php?ctrl=security&action=login"method="post">
<label for="email">Email</label>
<input type="email" name="email" id="email" value="lea@gmail.com" required><br>

<label for="password">Mot de passe</label>
<input type="password" name="password" id="password" value="AZERTY12345" required><br>

<div class="g-recaptcha" data-sitekey="6LeUhkYqAAAAALeAYNXSofNNSW3Fw9vzIRzl4Ngw" data-action="LOGIN" required></div>
<br/>
<input type="submit" name="submitLogin" value="Se connecter">
<script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>

<!-- Lien vers la vue forgotPassword -->
<p><a href="index.php?ctrl=security&action=forgotPassword">Mot de passe oublié ?</a></p>

</form>
</div>

