<?php  
  
?>

<h1>Donner un avis</h1>
<form action="index.php?ctrl=location&action=donnerAvis" method="post">
    <label for="commentaire">Commentaire</label>
    <textarea name="commentaire"></textarea>
    <input type="hidden" name="annonce_id" value="<?= $annonce->getId() ?>">
    <input type="submit" name="submitAvis" value="Envoyer l'avis">
</form>