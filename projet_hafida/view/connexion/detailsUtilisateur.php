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
        echo  
        "</p>  Nombre de chats:".$reservation->getAnnonce()->getNbChat()."<br>".
        " Date de début: ".date('d-m-Y', strtotime($reservation->getAnnonce()->getDateDebut()))."<br>". 
        " Date de fin: ".date('d-m-Y', strtotime($reservation->getAnnonce()->getDateFin()))."<br>".
        " Description: ". $reservation->getAnnonce()->getDescription()."<br>".
        " Numéro de téléphone: " . $reservation->getNumeroTelephone() ."<br>".
        " Nombre d'adultes:" .$reservation->getNbAdultes() ."<br>".
        " Nombre d'enfants:". $reservation->getNbEnfants() ."<br>".
        " Mode de paiement:" .$reservation->getPaiement() ."<br>".
        " Question:" .$reservation->getQuestion() ."<br>"."</p>"."<br>"."<br>";
         
    //Création du bouton "Poster un avis" dans la boucle foreach pour pouvoir poster un avis pour chaque annonce   
    ?>  
 <!-- Lien vers le formulaire d'avis pour l'annonce spécifique -->
    <a href='index.php?ctrl=location&action=avisAnnonce&id=<?= $reservation->getAnnonce()->getId() ?>'><button>Poster un avis</button></a>
<?php } ?>
 <?php
    } 
    
 else { echo "<p>Aucune réservation pour le moment.</p>"; 
    }
?>


<br>
<h1>Mes logements:</h1>
<br>
<br>
<!--Création du bouton "créer un nouveau logement" pour faire le lien vers le formulaire "Créer un logement"-->
<a href="index.php?ctrl=location&action=creationLogement"><button>Créer un nouveau logement</button></a><br>

        
   
   
       
