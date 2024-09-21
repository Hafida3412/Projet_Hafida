<?php
//On définit la variable $logements qui contient la liste des logements disponibles
    $logements = $result["data"]['logements'];   
?>
<main class="bg-annonces">
    <h1>Déposer une annonce</h1>
    
    <?php
  ?> 

<div class="alert alert-warning">
            <p>Avant de déposer une annonce, vous devez d'abord créer un logement. 
               Veuillez suivre les étapes ci-dessous :</p>
            <ul>
                <li>Cliquez sur le bouton "Créer un nouveau logement" ci-dessous.</li>
                <li>Remplissez le formulaire de création de logement avec toutes les informations nécessaires.</li>
            </ul>
        </div>

        <div class="logement-actions">
    <div class="button-container">
        <a href="index.php?ctrl=location&action=creationLogement">
            <button class="btn-reserver create-logement">Créer un nouveau logement</button>
        </a>
    </div>
</div>

<!--Création du formulaire pour déposer une annonce-->  
<div class= "container-creation">
    <form action="index.php?ctrl=location&action=ajoutAnnonces" method="post">
        <!--on ne rajoute pas de "id" à ajoutAnnonces pour ne pas insérer l'id 
        de l'utilisateur dans l'Url, trop dangereux.-->
        <label for="dateDebut">Date de début</label>
<!--Pour éviter que l'utilisateur sélectionne une date antérieure à celle où il se connecte-->         
        <input type="date" id="dateDebut" name="dateDebut" min="<?= date('Y-m-d'); ?>" required><br>

        <label for="dateFin">Date de fin</label>
        <input type="date" id="dateFin" name="dateFin" required><br>

        <label for="NbChat">Nombre de chat à garder:</label>
        <input type="number" name="nbChat"><br>

        <label for="logements">Adresse du logement</label> 
        <select name="logements"><!--boucle pour récupérer les éléments via id_logement dans un menu déroulant-->
        <?php foreach($logements as $logement): ?>
          <!--Chaque option affiche l'adresse complète du logement, le type de logement et le nombre de chambres-->
        <option value ="<?= $logement->getId() ?>"><?= $logement->getAdresseComplete() ?>:<?= $logement->getTypeLogement() ?> 
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

        <script>
    // Écouteur d'événement sur le champ de date de début
    document.getElementById('dateDebut').addEventListener('change', function() {
        // Récupère la date sélectionnée
        var dateDebut = new Date(this.value);
        // Active le champ de date de fin
        var dateFinInput = document.getElementById('dateFin');
        dateFinInput.disabled = false;

        // Réinitialiser la date de fin et configurer le minimum
        dateFinInput.min = this.value; // Le minimum de dateFin doit être égale à dateDebut
        dateFinInput.value = this.value; // Réinitialise dateFin pour correspondre à dateDebut (si l'on veut que par défaut cela soit la même date)
    });
</script>
