<?php
//On définit la variable $logements qui contient la liste des logements disponibles
    $logements = $result["data"]['logements'];   
?>
<main class="bg-annonces">
    <h1>Déposer une annonce</h1>
    
    <?php
  ?> 
<!--Création du formulaire pour déposer une annonce-->  
<div class= "container-creation">
    <form action="index.php?ctrl=location&action=ajoutAnnonces" method="post">
        <!--on ne rajoute pas de "id" à ajoutAnnonces pour ne pas insérer l'id 
        de l'utilisateur dans l'Url, trop dangereux.-->
        <label for="dateDebut">Date de début</label>
        <input type="date" name="dateDebut"><br>

        <label for="dateFin">Date de fin</label>
        <input type="date" name="dateFin"><br>

        <label for="NbChat">Nombre de chat à garder:</label>
        <input type="number" name="nbChat"><br>

        <label for="logements">Logements</label> 
        <select name="logements"><!--boucle pour récupérer les éléments via id_logement dans un menu déroulant-->
        <?php foreach($logements as $logement): ?>
          <!--Chaque option affiche l'adresse complète du logement, le type de logement et le nombre de chambres-->
        <option value="<?= $logement->getId() ?>"><?= $logement->getAdresseComplete() ?>:<?= $logement->getTypeLogement() ?> 
         avec <?= $logement->getNbChambre() ?> chambres.
        </option><!--cf public function getAdresseComplete créée dans l'"entities" logement-->
        <?php endforeach; ?>
        </select>
        <br>
        <br>
        <!--Création d'un champs de texte pour la description de l'annonce-->
        <label for="description">Description :</label>
        <textarea name="description" rows="4" cols="50"></textarea><br>

        <!--Création du bouton "Déposer l'annonce"-->
        <!-- Création d'un conteneur pour centrer le bouton -->
<div class="button-container">
    <input type="submit" name="submitAnnonce" value="Déposer l'annonce">
</div>
    </form>
        </div>
        </main>
