<?php
$utilisateur = $result["data"]['utilisateur']; 
$reservations = $result["data"]['reservations'];
?>

<h1>Mon Compte</h1>

<p>Pseudo: <?= $utilisateur->getPseudo() ?></p>
<p>Email: <?= $utilisateur->getEmail() ?></p>
<p>Nom: <?= $utilisateur->getNom() ?></p>
<p>Prénom: <?= $utilisateur->getPrenom() ?></p>
<p>Rôle: <?= $utilisateur->getRole() ?></p>
<br>

<?php

?>

<h1>Mes réservations:</h1>
<?php

if(isset($reservations) && $reservations){
    foreach($reservations as $reservation){
        // On affiche les détails de chaque réservation
        echo "<p>Numéro de téléphone: " . $reservation->getNumeroTelephone() .
        " Nombre d'adultes:" .$reservation->getNbAdultes() ." Nombre d'enfants:". $reservation->getNbEnfants()
        ." Mode de paiement:" .$reservation->getPaiement() .
        " Question:" .$reservation->getQuestion() ."</p>"."<br>";
    }
} else {
    echo "<p>Aucune réservation pour le moment.</p>";
}
?>

<br>
<h1>Mes logements:</h1>
<br>
<br>
<!--Création du bouton "créer un nouveau logement" pour faire le lien vers le formulaire "Créer un logement"-->
<a href="index.php?ctrl=location&action=creationLogement"><button>Créer un nouveau logement</button></a><br>

        
   
   
       
