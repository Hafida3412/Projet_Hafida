<?php  
  
?>

<h1>Poster un avis</h1>
<form action="index.php?ctrl=location&action=donnerAvis&id=<?= $id ?>" method="post">
    <label for="commentaire">Commentaire</label>
    <textarea name="commentaire"></textarea>
    <input type="hidden" name="annonce_id" value="<?= $id ?>">
    <input type="submit" name="submitAvis" value="Envoyer l'avis">
</form>