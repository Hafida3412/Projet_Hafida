<?php
    $annonces = $result["data"]['annonces']; 
?>

    <h1>Liste des annonces</h1>

<?php

if($annonces){
foreach($annonces as $annonce){ 
    echo "<div class='annonce'>"; // Ouverture du cadre de l'annonce
    echo "<p>"."Annonce de <a href='index.php?ctrl=location&action=detailsAnnonce&id=".$annonce->getId()."'>"
    .$annonce->getUtilisateur()->getPseudo()."</a>" ." du "
    .(date('d-m-Y H:i:s', strtotime($annonce->getDateCreation()))).
    "<br> Nb de chats: ".$annonce->getNbChat()."<br>
    Date de début: ".(date('d-m-Y ', strtotime($annonce->getDateDebut())))."<br>
    Date de fin: ".(date('d-m-Y ', strtotime($annonce->getDateFin()))).
    "<br> Description: ".$annonce->getDescription()."<br> 
    Ville: ".$annonce->getLogement()->getVille();

    if(App\Session::getUtilisateur() && App\Session::getUtilisateur()->getId() == $annonce->getUtilisateur()->getId()) { ?>
        <form method="post" action="index.php?ctrl=location&action=supprimerAnnonce&id=<?php echo $annonce->getId(); ?>">
            <button class="btn-delete"on  type="submit" name="submitDelete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">Supprimer</button>
        </form>
    <?php } 
    echo "</p></div>"; // Fermeture du cadre de l'annonce</p>
}
} else {
echo "<p>Pas d'annonce à supprimer pour le moment</p>";
}

    ?>
