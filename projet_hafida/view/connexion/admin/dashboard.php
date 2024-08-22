<?php

?>
<h1>Tableau de bord de l'administrateur</h1>
    
    <h2>Liste des annonces :</h2>
    <ul>
        <?php foreach($data["annonces"] as $annonce): ?>
            <li>
                <p><?= $annonce->getDescription(); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>