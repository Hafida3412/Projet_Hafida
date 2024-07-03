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

<?php

?>
<br>
<p>Mes logements:</p>
<br>
<br>
<!--Création du bouton "créer un nouveau logement" pour faire le lien vers le formulaire "Créer un logement"-->
<a href="index.php?ctrl=location&action=creationLogement"><button>Créer un nouveau logement</button></a><br>

        
   
   
       
