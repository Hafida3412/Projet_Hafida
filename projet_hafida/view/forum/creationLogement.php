<?php

?>
 <h1>Créer un logement</h1>
    <form action="index.php?ctrl=forum&action=creationLogement" method="post">
        <label for="nbChambre">Nombre de chambres:</label>
        <input type="number" name="nbChambre"><br>

        <label for="rue">Rue:</label>
        <input type="text" name="rue"><br>

        <label for="CP">Code postal:</label>
        <input type="text" name="CP"><br>

        <label for="ville">Ville:</label>
        <input type="text" name="ville"><br>

        <label for="image">URL de l'image du logement:</label>
        <input type="text" name="image"><br>

        <label for="typeLogement">Type de logement:</label>
        <select name="typeLogement">
            <option value="1">Maison</option>
            <option value="2">Appartement</option>
        </select>
        <br>

        <input type="submit" name="submitLogement" value="Créer le logement">
    </form>