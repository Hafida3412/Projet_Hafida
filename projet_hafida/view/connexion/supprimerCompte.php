<?php
use App\Session;
?>

<h1>Supprimer mon compte</h1>

<p>Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>

<!-- Affichage des messages de session (succès ou erreur) -->
<?php if(Session::getFlash('error')): ?>
    <!-- Si un message d'erreur est présent, on l'affiche dans un div avec la classe 'error' -->
    <div class="error"><?= Session::getFlash('error') ?></div>
<?php endif; ?>

<?php if(Session::getFlash('success')): ?>
    <!-- Si un message de succès est présent, on l'affiche dans un div avec la classe 'success' -->
    <div class="success"><?= Session::getFlash('success') ?></div>
<?php endif; ?>

<!-- Formulaire de confirmation de suppression de compte -->
<form method="post" action="index.php?ctrl=security&action=supprimerCompte">
    <!-- Bouton pour confirmer la suppression du compte -->
    <input type="submit" name="confirmDeletion" value="Confirmer la suppression">
</form>

<!-- Lien pour retourner à la page de gestion du compte -->
<p><a href="index.php?ctrl=security&action=monCompte">Retour à mon compte</a></p>
