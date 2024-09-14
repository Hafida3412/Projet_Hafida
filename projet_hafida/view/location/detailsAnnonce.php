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

<div class="details-container">
<div class="bg_details">
<div class="annonce-info">
    <!-- Affichage des informations de l'annonce -->
    <h2>Annonce de <?= htmlspecialchars($annonce->getUtilisateur()->getPseudo()) ?></h2>
        <p><strong>Nb de chats à garder:</strong> <?= $annonce->getNbChat() ?></p>
        <p><strong>Date de début:</strong> <?= date('d-m-Y', strtotime($annonce->getDateDebut())) ?></p>
        <p><strong>Date de fin:</strong> <?= date('d-m-Y', strtotime($annonce->getDateFin())) ?></p>
        <p><strong>Description:</strong><br> <?= nl2br(htmlspecialchars($annonce->getDescription())) ?></p>

        <!-- Affichage des informations sur le logement -->
        <hr>
        <h3>Informations sur le Logement</h3>
        <p><strong>Type de logement:</strong> <?= htmlspecialchars($logement->getTypeLogement()->getNomType()) ?></p>
        <p><strong>Nombre de chambres:</strong> <?= $logement->getNbChambre() ?></p>
        <p><strong>Ville:</strong> <?= htmlspecialchars($logement->getVille()) ?></p>


    <!-- Affichage de l'image du logement: -->
    <img src="<?= $logement->getImage()?>" alt="Image du logement" 
    class="annonce-info-img">
</div>
 
<div class="carousel">
    <div class="carousel-images">
        <?php
        // On vérifie si des images existent dans la variable $images
        if (!empty($images)) {
            // Affichage des images dans le carrousel
            // Parcours des images à l'aide d'une boucle foreach
            foreach ($images as $index => $image) {
                // Détermine si l'image actuelle est la première (index 0)
                $displayStyle = $index === 0 ? 'block' : 'none'; /// Afficher la première image et cacher les autres par défaut
                
                // Affiche chaque image dans un div avec la classe 'image-slide'
                // Utilise la propriété 'style' pour contrôler l'affichage
                echo '<div class="image-slide" style="display: ' . $displayStyle . ';">
                          <img src="public/upload/' . $image->getNomImage() . '" alt="Image" class="carousel-image">
                      </div>';
            }
        } else {
            // Si aucune image n'est disponible, afficher un message d'information
            echo '<p>Aucune image disponible pour ce logement.</p>';
        }
        ?>
    </div>
    <!-- Bouton pour aller à la diapositive précédente -->
    <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
    <!-- Bouton pour aller à la diapositive suivante -->
    <button class="next" onclick="changeSlide(1)">&#10095;</button>
</div>

<div class="avis">
    <strong><p>Avis:</strong>
    <?php
    // Vérification de l'existence d'avis
    if ($avis) {
        // Si des avis existent, on les affiche
        foreach ($avis as $avi) { ?> 
            <div class="avis-item">
                <?= htmlspecialchars($avi->getCommentaire()) ?> (le <?= date('d-m-Y', strtotime($avi->getDateAvis())) ?> par <?= htmlspecialchars($avi->getUtilisateur()->getPseudo()) ?>)
            </div>
        <?php 
        } 
    } else {
        echo "<p>Aucun avis pour cette annonce.</p>"; // Message quand il n'y a pas d'avis
    }
    ?> 
</div>
   <?php 
   // On vérifie si l'utilisateur connecté est le propriétaire de l'annonce
   if(App\Session::getUtilisateur() && App\Session::getUtilisateur()->getId() == $annonce->getUtilisateur()->getId()) { ?>
   <div class="upload_img upload-img-container">
   <!-- Formulaire pour uploader une nouvelle image -->
   <form action="index.php?ctrl=location&action=uploadImage&id=<?= 
   $annonce->getId() ?>" method="post" enctype="multipart/form-data">
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
    <a href="index.php?ctrl=reservations&action=reservation&annonceId=<?= $annonce->getId() ?>">
<button class="annonce-info" type="button">Réserver</button>
    </a>
    <br> </div></div>
    <?php   
}
?> 