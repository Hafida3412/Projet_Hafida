<?php

?>

<h1>Réinitialiser le mot de passe</h1>
<form action="index.php?ctrl=security&action=resetPassword&token=<?php echo htmlspecialchars($token); ?>" method="post">
    <label for="password">Nouveau mot de passe</label>
    <input type="password" name="password" id="password" required><br>
    <input type="submit" name="submitResetPassword" value="Modifier le mot de passe">
</form>