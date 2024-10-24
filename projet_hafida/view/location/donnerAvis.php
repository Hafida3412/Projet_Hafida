<?php  
  
?>

<h1>Poster un avis sur mon expérience</h1>

<form action="index.php?ctrl=location&action=donnerAvis&id=<?= $id?>" method="post">
    <label for="commentaire">Commentaires:</label><br>
    <textarea name="commentaire" rows="10" cols="200"></textarea><br>
    <input type="submit" name="submitAvis" value="Poster l'avis">
</form>

