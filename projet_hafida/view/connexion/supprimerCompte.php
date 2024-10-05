<?php
use App\Session;
?>

<h1>Supprimer mon compte</h1>
<p>Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>

<!-- Affichage des messages de session (succès ou erreur) -->
<?php if(Session::getFlash('error')): ?>
    <div class="error"><?= Session::getFlash('error') ?></div>
<?php endif; ?>

<?php if(Session::getFlash('success')): ?>
    <div class="success"><?= Session::getFlash('success') ?></div>
<?php endif; ?>

<form method="post" action="index.php?ctrl=security&action=supprimerCompte">
    <input type="submit" name="confirmDeletion" value="Confirmer la suppression">
</form>

<p><a href="index.php?ctrl=security&action=monCompte">Retour à mon compte</a></p>
