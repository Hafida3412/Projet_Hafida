<?php
    $annonces = $result["data"]['annonces']; 
?>

<h1>Liste des annonces</h1>

<?php
foreach($annonces as $annonce){ ?>
    <p><a href="index.php?ctrl=forum&action=listLogementsByAnnonce&id=<?= $annonce->getId() ?>"><?= $annonce->getdateCreation() ?></a></p>
<?php }


  
