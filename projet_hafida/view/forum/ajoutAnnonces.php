<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

    <h1>Déposer une annonce</h1>

    <form action="index.php?ctrl=forum&action=" method="post">
        <label for="dateDebut">Date début</label>
        <input type="date" name="dateDebut"><br>

        <label for="dateFin">Date fin</label>
        <input type="date" name="date"><br>

        <label for="typelogement">Type de logement</label>
        <input type="text" name="text"><br>

        <label for="NbChambre">Nombre de chambre:</label>
        <input type="text" name="text"><br>

        <label for="NbChat">Nombre de chat:</label>
        <input type="text" name="text"><br>

        <label for="Description">Description</label>
        <input type="text" name="text"><br>
        
        <input type="submit" name="submitAnnonce" value="Valider">

    </form>

    </body>
    
</html>