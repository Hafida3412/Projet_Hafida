<?php
$annonce = $result["data"]['annonce'];
$logement = $annonce->getLogement(); 
$type = $logement->getType()->getNomType();

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


<p>Avis:</p>
<?php if(!empty($avis)): ?>
    <?php foreach($avis as $avi): ?>
        <p>Date de l'avis: <?= $avi->getDateAvis() ?></p>
        <p>Commentaire: <?= $avi->getCommentaire() ?></p>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun avis disponible.</p>
<?php endif; ?>