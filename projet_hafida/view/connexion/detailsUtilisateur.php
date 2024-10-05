<?php
$utilisateur = $result["data"]['utilisateur']; 
$reservations = $result["data"]['reservations'];

?>
<div class="details-utilisateur">
<!--Informations de l'utilisateur-->
<h1>Mon Compte</h1>
<div class="utilisateur-info">
    <p>Pseudo: <?= htmlspecialchars($utilisateur->getPseudo()) ?></p>
    <p>Email: <?= htmlspecialchars($utilisateur->getEmail()) ?></p>
    <p>Nom: <?= htmlspecialchars($utilisateur->getNom()) ?></p>
    <p>Prénom: <?= htmlspecialchars($utilisateur->getPrenom()) ?></p>
    <p>Rôle: <?= htmlspecialchars($utilisateur->getRole()) ?></p>
</div>

<!-- Formulaire de modification des données personnelles -->
<div class="utilisateur-info">
<form method="post" action="index.php?ctrl=security&action=updateInfo">
    <input type="text" name="pseudo" value="<?= htmlspecialchars($utilisateur->getPseudo()) ?>" required><br>
            
            <label for="email">Votre nouvel Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($utilisateur->getEmail()) ?>"><br>

            <label for="password">Votre nouveau mot de passe:</label>
            <input type="password" name="password" placeholder="Nouveau mot de passe"><br>
            <!-- Afficher un message de succès ou d'erreur, si nécessaire -->
            <?php if(!empty($message)): ?>
                <div class="message"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

        <input type="submit" name="submitUpdate" value="Modifier mes données personnelles">
</form>
</div>

<!-- Réservations -->
<h1>Mes réservations</h1>
<div class="reservations">
<?php

if(isset($reservations) && $reservations){
    foreach($reservations as $reservation){
        // On affiche les détails de chaque réservation
        echo  
        "<p>"."<u>Ma réservation:</u>"."<br>". // Ajout des balises <u> pour souligner le texte
        " Nombre de chats:".$reservation->getAnnonce()->getNbChat()."<br>".
        " Date de début: ".date('d-m-Y', strtotime($reservation->getAnnonce()->getDateDebut()))."<br>". 
        " Date de fin: ".date('d-m-Y', strtotime($reservation->getAnnonce()->getDateFin()))."<br>".
        " Description: ". $reservation->getAnnonce()->getDescription()."<br>".
        " Numéro de téléphone: " . $reservation->getNumeroTelephone() ."<br>".
        " Nombre d'adultes:" .$reservation->getNbAdultes() ."<br>".
        " Nombre d'enfants:". $reservation->getNbEnfants() ."<br>".
        " Mode de paiement:" .$reservation->getPaiement() ."<br>".
        " Question:" .$reservation->getQuestion() ."<br>";
         
    //Création du bouton "Poster un avis" dans la boucle foreach pour pouvoir poster un avis pour chaque annonce   
    ?>  
 <a href="index.php?ctrl=location&action=donnerAvis&id=<?= $reservation->getAnnonce()->getId() ?>"><button>Poster un avis</button></a></p>
<?php } ?>
 <?php
    } 
    
 else { echo "Aucune réservation pour le moment."; 
    }
?>

</div>

<!-- Créer un logement -->

<h1>Mes logements</h1>

    <div class="button-container">
        <a href="index.php?ctrl=location&action=listeLogementsUtilisateur">
            <button class="btn-reserver see-logements">Voir mes logements</button>
        </a>
    </div>


   
       
