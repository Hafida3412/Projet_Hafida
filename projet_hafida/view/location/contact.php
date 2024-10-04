<?php

?>

<!-- Formulaire permettant à l'utilisateur de contacter le service client -->
<h1>Contactez notre service client</h1>

<form action="index.php?ctrl=location&action=contact" method="post">
    <!-- Champ pour le nom de l'utilisateur -->
    <label for="nom">Nom:</label><br>
    <input type="text" name="nom" required><br><br>

    <!-- Champ pour l'email de l'utilisateur -->
    <label for="email">Email:</label><br>
    <input type="email" name="email" required><br><br>

    <!-- Champ pour le message que l'utilisateur souhaite envoyer -->
    <label for="message">Message:</label><br>
    <textarea name="message" rows="4" cols="50" required></textarea><br><br>

    <!-- Conteneur pour le bouton de soumission -->
    <div class="submit-container">
    <!-- Bouton pour envoyer le formulaire -->
    <input type="submit" value="Envoyer">
    </div>
</form>
