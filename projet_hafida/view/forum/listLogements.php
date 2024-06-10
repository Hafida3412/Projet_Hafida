<?php
use Model\Entities\Utilisateur;

    $annonce = $result["data"]['annonce']; 
    $logements = $result["data"]['logements']; 

 ?>

<h1>Liste des logements</h1>

<?php

foreach($logements as $logement ){ ?>
    <p><a href="#"><?= $logement->getNomType()->getId() ?></a> de <?= $logement->getUtilisateur()->getId() ?></p>
<?php 

}
