<?php

?>
 <h1>Créer un logement</h1>
 <!-- Formulaire pour créer un logement -->
    <form action="index.php?ctrl=location&action=creationLogement" method="post">
         <!-- Champ pour le nombre de chambres -->
        <label for="nbChambre">Nombre de chambres:</label>
        <input type="number" name="nbChambre" required><br>

        <!-- Champ pour l'adresse (rue) -->
        <label for="rue">Rue:</label>
        <input type="text" name="rue" required><br>

        <!-- Champ pour le code postal -->
        <label for="CP">Code postal:</label>
        <input type="text" name="CP" required><br>

        <!-- Champ pour la ville -->
        <label for="ville">Ville:</label>
        <input type="text" name="ville" required><br>

        <!-- Champ pour l'URL de l'image -->
        <label for="image">URL de l'image du logement:</label>
        <input type="text" name="image" required><br>

        <!-- Sélecteur pour le type de logement -->
        <label for="typeLogement">Type de logement:</label>
        <select name="typeLogement">
            <option value="1">Maison</option> <!-- Option pour Maison -->
            <option value="2">Appartement</option> <!-- Option pour Appartement -->
        </select>
        <br>

        <!-- Bouton de soumission du formulaire -->
        <input type="submit" name="submitLogement" value="Créer le logement">
    </form>