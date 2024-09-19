<?php

?>

<h1>Réinitialiser le Mot de Passe</h1>
<form action="index.php?ctrl=security&action=resetPassword" method="post">
    <label for="newPassword">Nouveau Mot de Passe</label>
    <input type="password" name="newPassword" id="newPassword" required>
    <input type="submit" name="submitResetPassword" value="Réinitialiser le Mot de Passe">
</form>