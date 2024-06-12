<?php
$annonce = $result["data"]['annonce'];//on récupère les annonces
$avis = $result["data"]['avis'];//on récupère les avis
$logement = $annonce->getLogement(); 
$type = $logement->getTypeLogement()->getNomType();

?>

<h1>Détails de l'annonce</h1>

<p>Annonce de <?= $annonce->getUtilisateur()->getPseudo() ?></p>
<p>Nb de chats: <?= $annonce->getNbChat() ?></p>
<p>Date de début: <?= (date('d-m-Y ', strtotime($annonce->getDateDebut())))?></p>
<p>Date de fin: <?= (date('d-m-Y ', strtotime($annonce->getDateFin()))) ?></p>
<p>Description: <?= $annonce->getDescription() ?></p>

<p>Type de logement: <?= $logement->getTypeLogement() ?></p>
<p>Nombre de chambres: <?= $logement->getNbChambre() ?></p>
<p>Ville: <?= $logement->getVille() ?></p>
<img src="<?= $logement->getImage() ?>" alt="Image du logement">


<p><br>Avis:</p>
<?php
foreach($avis as $avi){ ?> <!--"avi" au singulier car on récupére un élément-->
   <p><?= $avi->getCommentaire() ?> <?= ((date('d-m-Y ', strtotime($avi->getDateAvis())))) ?> par <?= $avi->getUtilisateur()?></p>
<?php }