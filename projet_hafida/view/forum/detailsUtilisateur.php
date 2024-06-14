<?php
$utilisateur = $result["data"]['utilisateur'];   
?>

<h1>Mon Compte</h1>

<p>Pseudo: <?= $utilisateur->getPseudo() ?></p>
<p>Email: <?= $utilisateur->getEmail() ?></p>
<p>Nom: <?= $utilisateur->getNom() ?></p>
<p>Prénom: <?= $utilisateur->getPrenom() ?></p>
<p>Rôle: <?= $utilisateur->getRole() ?></p>

<p>Mes annonces: </p>


