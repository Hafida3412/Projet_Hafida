<h1>Éditer l'Annonce</h1>

<!-- Formulaire pour éditer une annonce -->
<form method="POST">
    <!-- Champ pour entrer le nombre de chats -->
    <label for="nbChat">Nombre de Chats</label>
    <input type="number" name="nbChat" id="nbChat" value="<?php 
    echo $result['data']['annonce']->getNbChat(); ?>" required><!--on récupère le nb de chat d'une annonce dans une BDD -->
    
    <!-- Champ pour sélectionner la date de début -->
    <label for="dateDebut">Date de Début</label>
    <input type="date" name="dateDebut" id="dateDebut" value="<?php 
    echo date('Y-m-d', strtotime($result['data']['annonce']->getDateDebut())); ?>" required>

    <!-- Champ pour sélectionner la date de fin -->
    <label for="dateFin">Date de Fin</label>
    <input type="date" name="dateFin" id="dateFin" value="<?php 
    //on récupére une date de la structure de données $result, la convertit en un timestamp avec strtotime(), 
    //puis reformate ce timestamp pour afficher la date sous la forme 'aaaa-mm-jj':
    echo date('Y-m-d', strtotime($result['data']['annonce']->getDateFin())); ?>" required>

     <!-- Champ pour entrer la description de l'annonce -->
    <label for="description">Description</label>
    <textarea name="description" id="description" required><?php 
    echo $result['data']['annonce']->getDescription(); ?></textarea>

    <!-- Checkbox pour indiquer si l'annonce est valide -->
    <label for="estValide">Annonce Valide</label>
    <input type="checkbox" name="estValide" id="estValide" <?php 
    echo $result['data']['annonce']->getEstValide() ? 'checked' : ''; ?>>

    <!-- Bouton pour soumettre le formulaire et mettre à jour l'annonce -->
    <button type="submit" class="btn-edit">Mettre à Jour</button>
</form>
