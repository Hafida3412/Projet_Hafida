<?php
$utilisateur = $result["data"]['utilisateur']; 

?>

<h1>Mon Compte</h1>

<p>Pseudo: <?= $utilisateur->getPseudo() ?></p>
<p>Email: <?= $utilisateur->getEmail() ?></p>
<p>Nom: <?= $utilisateur->getNom() ?></p>
<p>Prénom: <?= $utilisateur->getPrenom() ?></p>
<p>Rôle: <?= $utilisateur->getRole() ?></p>
<br>
<p>Mes annonces:</p>
<?php
if(!empty($annonces)) {
    foreach($annonces as $annonce) {
        echo "<p>"."Annonce de <a href='index.php?ctrl=forum&action=detailsAnnonce&id=".$annonce->getId()."'>"
        .$annonce->getUtilisateur()->getPseudo()."</a>" ." du "
        .(date('d-m-Y H:i:s', strtotime($annonce->getDateCreation()))).
        "<br>Nb de chats: ".$annonce->getNbChat()."<br>Date de début: "
        (date('d-m-Y', strtotime($annonce->getDateDebut())))."<br>Date de fin: "
        .(date('d-m-Y', strtotime($annonce->getDateFin())))."<br>Description: "
        .$annonce->getDescription()."</p><br>";
    }
} else {
    echo "<p>Pas d'annonces à afficher pour le moment.</p>";
}

?>
<br>
<p>Mes logements:</p>
<?php
        
        
   
   
       
