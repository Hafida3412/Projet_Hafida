<?php
$utilisateur = $result["data"]['utilisateur']; 
$reservations = $result["data"]['reservations'];

?>
<!--Informations de l'utilisateur-->
<h1>Mon Compte</h1>
<div class="utilisateur-info">
<p>Pseudo: <?= $utilisateur->getPseudo() ?></p>
<p>Email: <?= $utilisateur->getEmail() ?></p>
<p>Nom: <?= $utilisateur->getNom() ?></p>
<p>Prénom: <?= $utilisateur->getPrenom() ?></p>
<p>Rôle: <?= $utilisateur->getRole() ?></p>
</div>


<!-- Formulaire de modification des données personnelles -->
<div class="utilisateur-info">
<form method="post" action="index.php?ctrl=security&action=updateInfo">
    <label for="pseudo">Pseudo:</label>
    <input type="text" name="pseudo" value="<?= $utilisateur->getPseudo() ?>"><br>
    
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?= $utilisateur->getEmail() ?>"><br>
    
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
<div class="create-logement"></div>
<h1>Mes logements</h1>

<!--Création du bouton "créer un nouveau logement" pour faire le lien vers le formulaire "Créer un logement"-->
<a href="index.php?ctrl=location&action=creationLogement"><button class="btn-reserver">Créer un nouveau logement</button></a><br>
</div>


<!--Création du bouton "voir mes logements" pour faire la redirection vers la vue "listeLogementsUtilisateur.php-->
<a href="index.php?ctrl=location&action=listeLogementsUtilisateur"><button class="btn-reserver">Voir mes logements</button></a><br>

   
   
       
