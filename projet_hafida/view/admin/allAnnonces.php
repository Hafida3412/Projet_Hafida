<!--Ce code affiche la liste des annonces récupérées depuis la base de données-->
<?php
$annonces = $result["data"]['annonces']; 
?>

<main class="bg-annonces">
    <h1>Profitez de l’opportunité de garder un chat à domicile pendant
       l’absence de son <br> propriétaire!</h1>
<br>
<!--Création du formulaire de recherche d'annonce par ville-->
<form method="GET" action="index.php">
    <!-- Champ caché pour spécifier le contrôleur à utiliser -->
    <input type="hidden" name="ctrl" value="location">
    <!-- Champ caché pour spécifier l'action à effectuer -->
    <input type="hidden" name="action" value="rechercheAnnonce">

    <!-- Étiquette pour le champ de ville -->
    <label for="ville">Rechercher par ville</label>
    <!-- Champ de saisie pour entrer le nom de la ville -->
    <input type="text" name="ville" id="ville" placeholder="Entrez une ville">
    <!-- Bouton pour soumettre le formulaire -->
    <button class="annonce-info" type="submit">Rechercher</button>
</form>

    <h1>Consulter les annonces</h1>
   
    <div class="annonce-container">
<?php

if (!empty($annonces)) {
foreach($annonces as $annonce){ //La boucle foreach parcourt chaque annonce et affiche les détails de celle-ci 
    echo "<div class='annonce'>"; // Ouverture du cadre de l'annonce
    
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
    if (App\Session::getUtilisateur() && App\Session::getUtilisateur()->hasRole("ROLE_ADMIN")) { ?>
      <div class="button-admin">
          <!-- Formulaire pour supprimer une annonce -->
          <form method="post" action="index.php?ctrl=location&action=supprimerAnnonce&id=<?php echo $annonce->getId(); ?>">
          <!-- Bouton de suppression avec confirmation -->   
          <button class="btn-delete" type="submit" name="submitDelete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">Supprimer</button>
          </form>
          
          <form method="get" action="index.php" style="display:inline;">
              <!-- Champ caché pour indiquer le contrôleur à utiliser -->
              <input type="hidden" name="ctrl" value="admin">
              <!-- Champ caché pour spécifier l'action à réaliser, ici l'édition d'une annonce -->
              <input type="hidden" name="action" value="editAnnonce">
              <!-- Champ caché pour transmettre l'identifiant unique de l'annonce à éditer -->
              <input type="hidden" name="id" value="<?php echo $annonce->getId(); ?>">
               <!-- Bouton de soumission qui permet de lancer l'édition de l'annonce -->
              <button class="btn-edit" type="submit">Éditer</button>
          </form>
      </div>
        <?php  ?>
    <?php } 
    
    echo "</p></div>"; // Fermeture du cadre de l'annonce</p>
    }
} else {
  echo "<p>Aucune annonce trouvée.</p>";
}

?>
</div>
</main>
<?php

// PAGINATION DE LA LISTE DES ANNONCES

// On définit la page courante
/*On utilise la fonction isset($_GET['page']) pour vérifier si la page est définie 
dans l'URL. Si c'est le cas, on utilise la valeur récupérée via intval($_GET['page']) 
pour convertir la valeur en entier. (Sinon, on peut utiliser la valeur 1 par défaut.)
*/
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Récupérer la page depuis l'URL
$totalPages = 3; //On définit la variable $totalPages qui représente le nombre total de pages.
?>








