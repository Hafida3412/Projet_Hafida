<?php

?>

<h1>Se connecter</h1>

<form action="index.php?ctrl=security&action=login"method="post">
<label for="email">Email</label>
<input type="email" name="email" id="email" value="micka@exemple.com"><br>

<label for="password">Mot de passe</label>
<input type="password" name="password" id="password" value="aaaaa"><br>
<input type="submit" name="submitLogin" value="Se connecter">
</form>
