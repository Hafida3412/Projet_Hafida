<?php
    $annonces = $result["data"]['annonces']; 
?>

<div class="container">
    <h1>Liste des annonces</h1>

    <?php if($annonces) {
        foreach($annonces as $annonce) { ?>
            <p>Annonce de <a href='index.php?ctrl=location&action=detailsAnnonce&id=<?php echo $annonce->getId(); ?>'><?php echo $annonce->getUtilisateur()->getPseudo(); ?></a> du <?php echo date('d-m-Y H:i:s', strtotime($annonce->getDateCreation())); ?><br>
            Nb de chats: <?php echo $annonce->getNbChat(); ?><br>
            Date de début: <?php echo date('d-m-Y', strtotime($annonce->getDateDebut())); ?><br>
            Date de fin: <?php echo date('d-m-Y', strtotime($annonce->getDateFin())); ?><br>
            Description: <?php echo $annonce->getDescription(); ?><br>
            Ville: <?php echo $annonce->getLogement()->getVille(); ?><br></p>

            <?php if(App\Session::getUtilisateur() && App\Session::getUtilisateur()->getId() == $annonce->getUtilisateur()->getId()) { ?>
                <form method="post" action="index.php?ctrl=location&action=supprimerAnnonce&id=<?php echo $annonce->getId(); ?>">
                    <button type="submit" name="submitDelete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">Supprimer</button>
                </form><br><br>
            <?php } ?>

        <?php }
    } else {
        echo "<p>Pas d'annonce à supprimer pour le moment</p>";
    } ?>

</div>