<?php
$annonce = $result["data"]['annonce'];//on récupère les annonces
$avis = $result["data"]['avis'];//on récupère les avis
$logement = $annonce->getLogement(); 
$type = $logement->getTypeLogement()->getNomType();

?>

<h1>Détails de l'annonce</h1>

<div class="annonce-info">
    <p>Annonce de <?= $annonce->getUtilisateur()->getPseudo()?><br>
    Nb de chats: <?= $annonce->getNbChat()?><br>
    Date de début: <?= (date('d-m-Y ', strtotime($annonce->getDateDebut())))?><br>
    Date de fin: <?= (date('d-m-Y ', strtotime($annonce->getDateFin())))?><br>
    Description: <?= $annonce->getDescription()?><br>

    Type de logement: <?= $logement->getTypeLogement()?><br>
    Nombre de chambres: <?= $logement->getNbChambre()?><br>
    Ville: <?= $logement->getVille()?><br>
    <img src="<?= $logement->getImage()?>" alt="Image du logement" class="annonce-info-img">
</div>

<div class="avis">
    <p>Avis:
    <?php
    if($avis) {
        foreach($avis as $avi){?> 
           <?= $avi->getCommentaire()?> (le <?= (date('d-m-Y ', strtotime($avi->getDateAvis())))?> par <?= $avi->getUtilisateur()?>)</p>
        <?php 
        }
    } else {
        echo "<p>Aucun avis pour cette annonce.</p>";
    }
   ?> 
   <form action="index.php?ctrl=location&action=uploadImage&id=<?= $logement->getId() ?>" method="post" enctype="multipart/form-data">
    <label for="file">Télécharger une image :</label>
    <input type="file" name="file" accept=".jpg, .png, .jpeg, .webp" required />
    <button type="submit">Uploader</button>
</form>

</div>

<?php
// On vérifie si l'utilisateur connecté n'est pas le propriétaire de l'annonce
if(App\Session::getUtilisateur() && $annonce->getUtilisateur()->getId()!= App\Session::getUtilisateur()->getId()) {
  ?>
   <!--création du bouton réserver qui fait le lien avec le formulaire de réservation-->
       <a href="index.php?ctrl=reservations&action=reservation&id=<?=$annonce->getId()?>"><button class="annonce-info" type="button">Réserver</button></a><br>
   <?php   
       }
?>