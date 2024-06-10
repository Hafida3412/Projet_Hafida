<?php
use Model\Entities\Utilisateur;
use Model\Managers\LogementManager;

    $annonce = $result["data"]['annonce']; 
    $logements = $result["data"]['logements']; 

 ?>

<h1>Liste de tous les logements</h1>

<ul>
    <?php foreach($logements as $logement): ?>
        <li>
            <strong>Rue: </strong><?= $logement->getRue() ?><br>
            <strong>CP: </strong><?= $logement->getCP() ?><br>
            <strong>Ville: </strong><?= $logement->getVille() ?><br>
            <img src="<?= $logement->getImage() ?>" alt="<?= $logement->getRue() ?>"><br>
        </li>
    <?php endforeach; ?>
</ul>
?>


