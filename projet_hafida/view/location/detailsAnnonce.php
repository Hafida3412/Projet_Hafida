<?php
// Récupération des données de l'annonce, des avis et des images à partir du tableau résultat
$annonce = $result["data"]['annonce'];//on récupère les annonces
$avis = $result["data"]['avis'];//on récupère les avis
$logement = $annonce->getLogement(); // On récupère l'objet 'logement' à partir de l'objet 'annonce'
// Récupération du type de logement
$type = $logement->getTypeLogement()->getNomType();/*On récupère le type de logement associé à l'objet 'logement'
et extrait le nom du type à partir de cet objet*/
$images = $result["data"]['images']; // On récupère les images
?>

<h1>Détails de l'annonce</h1>

<div class="annonce-info">
    <!-- Affichage des informations de l'annonce -->
    <p>Annonce de <?= $annonce->getUtilisateur()->getPseudo()?><br>
    Nb de chats: <?= $annonce->getNbChat()?><br>
    Date de début: <?= (date('d-m-Y ', strtotime($annonce->getDateDebut())))?><br>
    Date de fin: <?= (date('d-m-Y ', strtotime($annonce->getDateFin())))?><br>
    Description: <?= $annonce->getDescription()?><br>

    <!-- Affichage des informations sur le logement -->
    Type de logement: <?= $logement->getTypeLogement()?><br>
    Nombre de chambres: <?= $logement->getNbChambre()?><br>
    Ville: <?= $logement->getVille()?><br>

    <!-- Affichage de l'image du logement: -->
    <img src="<?= $logement->getImage()?>" alt="Image du logement" 
    class="annonce-info-img">
</div>
 
<div class="images">
    <h3>Voir plus d'images</h3>
    <?php
        // On vérifie si des images existent
        if (!empty($images)) {
            // Si des images existent, on les affiche
            foreach ($images as $image) {
                // Affichage des images
                echo '<img src="public/upload/' . $image->getNomImage() . '" width="200px"><br>';
            }
        } else {
            echo '<p>Aucune image disponible pour ce logement.</p>';
        }
    ?>
</div>

<div class="avis">
    <p>Avis:
    <?php
    // Vérification de l'existence d'avis
    if($avis) {
        // Si des avis existent, on les affiche
        foreach($avis as $avi){?> 
           <?= $avi->getCommentaire()?> (le <?= (date('d-m-Y ', 
           strtotime($avi->getDateAvis())))?> par <?= $avi->getUtilisateur()?>)</p>
        <?php 
        }
    } else {
        echo "<p>Aucun avis pour cette annonce.</p>";// Message quand il n'y a pas d'avis
    }
   ?> 
   </div>
   <?php 
   // On vérifie si l'utilisateur connecté est le propriétaire de l'annonce
   if(App\Session::getUtilisateur() && App\Session::getUtilisateur()->getId() == $annonce->getUtilisateur()->getId()) { ?>
   <div class="upload_img">
   <!-- Formulaire pour uploader une nouvelle image -->
        <form action="index.php?ctrl=location&action=uploadImage&id=
            <?= $logement->getId() ?>" method="post" enctype="multipart/form-data">
            <label for="file">Télécharger une image :</label>
            <input type="file" name="file" accept=".jpg, .png, .jpeg, .webp" required /><!-- Champ de saisie pour le fichier -->
            <button type="submit">Uploader</button><!-- Bouton pour soumettre le formulaire -->
        </form>
        </div>
    <?php
   }
   
// On vérifie si l'utilisateur connecté n'est pas le propriétaire de l'annonce
$utilisateurConnecte = App\Session::getUtilisateur();
if ($utilisateurConnecte && $annonce->getUtilisateur()->getId() != $utilisateurConnecte->getId()) {
    // Création du bouton réserver qui fait le lien avec le formulaire de réservation
    ?>
    <a href="index.php?ctrl=reservations&action=reservation&id=<?= $annonce->getId() ?>">
        <button class="annonce-info" type="button">Réserver</button>
    </a>
    <br>
    <?php   
}
?> 