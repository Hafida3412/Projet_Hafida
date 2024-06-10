<?php
    $annonces = $result["data"]['annonces']; 
?>

<h1>Liste des annonces</h1>

<?php
foreach($annonces as $annonce){ ?>
    <p><a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?></a></p>
<?php }


  
