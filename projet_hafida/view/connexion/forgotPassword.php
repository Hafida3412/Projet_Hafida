<?php

?>

<h1>Mot de passe oublié</h1>
<form action="index.php?ctrl=security&action=forgotPassword" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required><br>
    <input type="submit" name="submitForgotPassword" value="Envoyer le lien de réinitialisation">
</form>
