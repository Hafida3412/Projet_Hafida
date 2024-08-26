<!--Ce code affiche la liste des annonces récupérées depuis la base de données-->
<?php
$annonces = $result["data"]['annonces']; 
$message = $result["data"]['message']; // Récupération du message

// Affichage du message s'il n'y a aucune annonce correspondant à la ville recherchée
if ($message) {
    echo "<div class='alert alert-info'>$message</div>";
}
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
    //Détails de l'annonce:
    echo "<p>"."<strong>"."Annonce de ".$annonce->getUtilisateur()->getPseudo()."</strong>"."<br>" .
    (date('d-m-Y H:i:s', strtotime($annonce->getDateCreation()))).
    "<br> Nb de chats: ".$annonce->getNbChat()."<br>
    Date de début: ".(date('d-m-Y ', strtotime($annonce->getDateDebut())))."<br>
    Date de fin: ".(date('d-m-Y ', strtotime($annonce->getDateFin()))).
    "<br> Description: ".$annonce->getDescription()."<br> 
    Ville: ".$annonce->getLogement()->getVille()."<br> 
    <a href='index.php?ctrl=location&action=detailsAnnonce&id=".$annonce->getId()."'>Consulter</a>"."<br>";

    //Il peut également supprimer une annonce s'il en est l'auteur en cliquant sur le bouton "Supprimer" après confirmation
    if(App\Session::getUtilisateur() && App\Session::getUtilisateur()->getId() == $annonce->getUtilisateur()->getId()) { ?>
    <!--Un bouton "supprimer" est affiché au bas de chaque annonce de 'utilisateur connecté-->
        <form method="post" action="index.php?ctrl=location&action=supprimerAnnonce&id=<?php echo $annonce->getId(); ?>">
            <button class="btn-delete"on  type="submit" name="submitDelete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">Supprimer</button>
        </form>
    <?php } 
    echo "</p></div>"; // Fermeture du cadre de l'annonce</p>
    }
}

?>

<?php

// Pagination

// On définit la page courante

/*On utilise la fonction isset($_GET['page']) pour vérifier si la page est définie 
dans l'URL. Si c'est le cas, on utilise la valeur récupérée via intval($_GET['page']) 
pour convertir la valeur en entier. Sinon, on utilise la valeur 1 par défaut.
*/
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Récupérer la page depuis l'URL
$totalPages = 2 ; //On définit la variable $totalPages qui représente le nombre total de pages.
?>
<nav aria-label="Pagination">
  <ul class="pagination">
    <?php if ($page > 1): // Si la page courante n'est pas la première ?> 
      <li class="page-item">
    <a class="page-link" href="index.php?ctrl=location&action=index&page=<?php 
      echo $page - 1; ?>">Précédent</a></li>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): // Boucle FOR pour afficher les numéros de page?>
      <li class="page-item <?php if ($i == $page) 
      echo 'active'; ?>"><!--On utilise la classe active pour la page courante.-->
      <a class="page-link" href="index.php?ctrl=location&action=index&page=<?php 
      echo $i; ?>"><?php 
      echo $i; ?></a></li>
    <?php endfor; ?>

    <!--On utilise une condition if pour vérifier si la page courante est inférieure
     au nombre total de pages. Si c'est le cas, on affiche le lien "Suivant".-->
    <?php if ($page < $totalPages): // Si la page courante n'est pas la dernière?>
      <li class="page-item">
      <a class="page-link" href="index.php?ctrl=location&action=index&page=<?php 
      echo $page + 1; ?>">Suivant</a></li>
    <?php endif; ?>
  </ul>
</nav>






