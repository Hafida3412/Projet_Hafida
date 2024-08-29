<?php
// On extrait la liste des utilisateurs depuis le tableau de résultats
$annonces = $result["data"]["annonces"]; // Sert à éviter l'erreur si 'annonces' n'existe pas
?>

<h1>Toutes les annonces</h1>

<?php if (!empty($annonces)): ?>
    <div class="annonces-list">
        <?php foreach ($annonces as $annonce): ?>
            <div class='annonce'> <!-- Cadre de l'annonce -->
                <p><strong>Annonce de <?= htmlspecialchars($annonce->getUtilisateur()->getPseudo()) ?></strong><br>
                Date de création: <?= date('d-m-Y H:i:s', strtotime($annonce->getDateCreation())) ?><br>
                Nb de chats: <?= htmlspecialchars($annonce->getNbChat()) ?><br>
                Date de début: <?= date('d-m-Y', strtotime($annonce->getDateDebut())) ?><br>
                Date de fin: <?= date('d-m-Y', strtotime($annonce->getDateFin())) ?><br>
                Description: <?= htmlspecialchars($annonce->getDescription()) ?><br>
                Ville: <?= htmlspecialchars($annonce->getLogement()->getVille()) ?><br>
                État: <?= $annonce->getEstValide() ? 'Validé' : 'Non Validé' ?><br>
                <a href='index.php?ctrl=location&action=detailsAnnonce&id=<?= $annonce->getId() ?>'>Consulter</a>
                </p>
            </div> <!-- Fermeture du cadre de l'annonce -->
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucune annonce trouvée.</p>
<?php endif; ?>
