<?php

    $annonces = $result["data"]['annonces']; 
    
//var_dump("ok");die;
?>

<h1>Liste des annonces</h1>

<?php
foreach($annonces as $annonce){ ?>
    <p><a href="index.php?ctrl=forum&action=listLogementsByAnnonce&id=<?= $annonce->getId() ?>"><?= $annonce->getUtilisateur()->getId() ?></a></p>
   
<?php 

}


