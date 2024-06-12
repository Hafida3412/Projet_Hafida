<?php

    $annonces = $result["data"]['annonces']; 
    
?>

<h1>Liste des annonces</h1>

<?php

foreach($annonces as $annonce){ 
    echo "<p>"."Annonce de <a href='index.php?ctrl=forum&action=detailsAnnonce&id=".$annonce->getId()."'>".$annonce->getUtilisateur()->getPseudo()."</a>" ." du ".(date('d-m-Y H:i:s', strtotime($annonce->getDateCreation())))."<br> Nb de chats: ".$annonce->getNbChat()."<br>
    Date de début: ".(date('d-m-Y ', strtotime($annonce->getDateDebut())))."<br>
    Date de fin: ".(date('d-m-Y ', strtotime($annonce->getDateFin())))."<br> Description: ".$annonce->getDescription()."</p><br>";
}
