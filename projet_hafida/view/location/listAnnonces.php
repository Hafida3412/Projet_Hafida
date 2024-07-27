<!--Ce code affiche la liste des annonces récupérées depuis la base de données-->
<?php
    $annonces = $result["data"]['annonces']; 
?>
<br>
<!--Création du formulaire de recherche d'annonce par ville-->
<form method="GET" action="index.php">
    <input type="hidden" name="ctrl" value="location">
    <input type="hidden" name="action" value="rechercheAnnonce">

    <label for="ville">Rechercher par ville</label>
    <input type="text" name="ville" id="ville" placeholder="Entrez une ville">
    <button class="annonce-info" type="submit">Rechercher</button>
</form>

    <h1>Liste des annonces</h1>

<?php

if($annonces){
foreach($annonces as $annonce){ //La boucle foreach parcourt chaque annonce et affiche les détails de celle-ci 
    echo "<div class='annonce'>"; // Ouverture du cadre de l'annonce
    //L'utilisateur peut cliquer sur le pseudo de l'utilisateur pour accéder aux détails de l'annonce
    echo "<p>"." <a href='index.php?ctrl=location&action=detailsAnnonce&id=".$annonce->getId()."'>"
    ."Annonce de ".$annonce->getUtilisateur()->getPseudo()."</a>"."<br>"
    .(date('d-m-Y H:i:s', strtotime($annonce->getDateCreation()))).
    "<br> Nb de chats: ".$annonce->getNbChat()."<br>
    Date de début: ".(date('d-m-Y ', strtotime($annonce->getDateDebut())))."<br>
    Date de fin: ".(date('d-m-Y ', strtotime($annonce->getDateFin()))).
    "<br> Description: ".$annonce->getDescription()."<br> 
    Ville: ".$annonce->getLogement()->getVille();

    //Il peut également supprimer une annonce s'il en est l'auteur en cliquant sur le bouton "Supprimer" après confirmation
    if(App\Session::getUtilisateur() && App\Session::getUtilisateur()->getId() == $annonce->getUtilisateur()->getId()) { ?>
        <form method="post" action="index.php?ctrl=location&action=supprimerAnnonce&id=<?php echo $annonce->getId(); ?>">
            <button class="btn-delete"on  type="submit" name="submitDelete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">Supprimer</button>
        </form>
    <?php } 
    echo "</p></div>"; // Fermeture du cadre de l'annonce</p>
    }
}

    ?>
