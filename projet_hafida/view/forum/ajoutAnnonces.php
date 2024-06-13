<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

    <h1>Déposer une annonce</h1>
    
    <?php
  ?> 
    <form action="index.php?ctrl=forum&action=ajoutAnnonces" method="post">
        <label for="dateDebut">Date début</label>
        <input type="date" name="dateDebut"><br>

        <label for="dateFin">Date fin</label>
        <input type="date" name="dateFin"><br>

        <label for="NbChat">Nombre de chat:</label>
        <input type="number" name="nbChat"><br>

        <label for="description">Description :</label>
        <textarea name="description" rows="4" cols="50"></textarea><br>

        <input type="submit" name="submitAnnonce" value="Déposer l'annonce">
    </form>
    
    </body>
    
</html>