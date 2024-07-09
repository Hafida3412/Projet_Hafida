<?php  
  
?>

<h1>Poster un avis pour cette annonce</h1>
<form action="index.php?ctrl=location&action=donnerAvis&id=<?= $annonce_id ?>" method="post">
    <label for="commentaire">Commentaire</label>
    <textarea name="commentaire"></textarea>
    <input type="submit" name="submitAvis" value="Poster l'avis">
</form>

