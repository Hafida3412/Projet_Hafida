<?php
    $logements = $result["data"]['logements'];   
?>

    <h1>Déposer une annonce</h1>
    
    <?php
  ?> 
    <form action="index.php?ctrl=forum&action=ajoutAnnonces" method="post">
        <!--on ne rajoute pas de "id" à ajoutAnnonces pour ne pas insérer l'id de l'utilisateur dans l'Url, trop dangereux.-->
        <label for="dateDebut">Date début</label>
        <input type="date" name="dateDebut"><br>

        <label for="dateFin">Date fin</label>
        <input type="date" name="dateFin"><br>

        <label for="NbChat">Nombre de chat:</label>
        <input type="number" name="nbChat"><br>

        <label for="logements">Logements:</label> 
        <select name="logements"><!--boucle pour récupérer les éléments via id_logement dans un menu déroulant-->
        <?php foreach($logements as $logement): ?>
        <option value="<?= $logement->getId() ?>"><?= $logement->getAdresseComplete() ?>
        </option><!--cf public function getAdresseComplete créee dans l'"entities" logement-->
        <?php endforeach; ?>
        </select>
        <br>
        
        <label for="NbChambre">Nombre de chambre:</label>
        <input type="number" name="nbChambre"><br>

        <label for="image">Photos:</label> 
        <input type = "image" name= "image">

        <br>
        <br>
        <label for="description">Description :</label>
        <textarea name="description" rows="4" cols="50"></textarea><br>

        <input type="submit" name="submitAnnonce" value="Déposer l'annonce">
    </form>
    
