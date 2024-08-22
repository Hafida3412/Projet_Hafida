<?php

?>
<img src="public\img\chat.png" alt="regard d'un chat" style="width: 100%; height: auto; object-fit: contain;">
<h1>Se connecter</h1>

<form action="index.php?ctrl=security&action=login"method="post">
<label for="email">Email</label>
<input type="email" name="email" id="email" value="lea@gmail.com"><br>

<label for="password">Mot de passe</label>
<input type="password" name="password" id="password" value="helloworld"><br>

<input type="submit" name="submitLogin" value="Se connecter">
</form>

<!--CREATION DU POP UP COOKIE-->
<div id="cookie-popup">
  <p>Notre site utilise des cookies pour améliorer votre expérience. En continuant à naviguer sur notre site, vous acceptez l'utilisation de ces cookies.</p>
      <button id="accept-cookies" onclick="acceptCookies()">J'accepte</button>
      <button id="refuse-cookies" onclick="refuseCookies()">Je refuse</button>
</div>