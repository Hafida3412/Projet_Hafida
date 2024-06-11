<?php
$annonce = $result["data"]['annonce'];
$logement = $annonce->getLogement(); 
$type = $logement->getType()->getNomType();
// Modifier pour obtenir tous les avis du logement
//$avis = $logement->getAvis();
?>


<h1>Détails de l'annonce</h1>

<p>Annonce de <?= $annonce->getUtilisateur()->getPseudo() ?></p>
<p>Nb de chats: <?= $annonce->getNbChat() ?></p>
<p>Date de début: <?= (date('d-m-Y ', strtotime($annonce->getDateDebut())))?></p>
<p>Date de fin: <?= (date('d-m-Y ', strtotime($annonce->getDateFin()))) ?></p>
<p>Description: <?= $annonce->getDescription() ?></p>

<p>Type de logement: <?= $logement->getType()->getNomType() ?></p>
<p>Nombre de chambres: <?= $logement->getNbChambre() ?></p>
<p>Ville: <?= $logement->getVille() ?></p>
<img src="<?= $logement->getImage() ?>" alt="Image du logement">

