<h1>Éditer l'Annonce</h1>

<form method="POST">
    <label for="nbChat">Nombre de Chats</label>
    <input type="number" name="nbChat" id="nbChat" value="<?php echo $result['data']['annonce']->getNbChat(); ?>" required>
    
    <label for="dateDebut">Date de Début</label>
    <input type="date" name="dateDebut" id="dateDebut" value="<?php echo date('Y-m-d', strtotime($result['data']['annonce']->getDateDebut())); ?>" required>

    <label for="dateFin">Date de Fin</label>
    <input type="date" name="dateFin" id="dateFin" value="<?php echo date('Y-m-d', strtotime($result['data']['annonce']->getDateFin())); ?>" required>

    <label for="description">Description</label>
    <textarea name="description" id="description" required><?php echo $result['data']['annonce']->getDescription(); ?></textarea>

    <label for="estValide">Annonce Valide</label>
    <input type="checkbox" name="estValide" id="estValide" <?php echo $result['data']['annonce']->getEstValide() ? 'checked' : ''; ?>>

    <button type="submit" class="btn-edit">Mettre à Jour</button>
</form>
