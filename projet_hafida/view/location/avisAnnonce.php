<?php  
  
?>

<h1>Poster un avis pour cette annonce</h1>
<form action="index.php?ctrl=location&action=donnerAvis&id=<?= $annonce_id ?>" method="post">
    <label for="commentaire">Commentaires:</label><br>
    <textarea name="commentaire" rows="4" cols="50"></textarea><br>
    <input type="submit" name="submitAvis" value="Poster l'avis">
</form>

