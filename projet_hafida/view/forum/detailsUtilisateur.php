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


        
   
   
       
