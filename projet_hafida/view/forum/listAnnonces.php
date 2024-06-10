<?php

    $annonces = $result["data"]['annonces']; 
    
//var_dump("ok");die;
?>

<h1>Liste des annonces</h1>

<?php

foreach($annonces as $annonce){ 
    echo "<p>"."Annonce de ".$annonce->getUtilisateur()->getPseudo()." du ".(date('d-m-Y H:i:s', strtotime($annonce->getDateCreation())))."<br> Nb de chats: ".$annonce->getNbChat()."<br>
    Date de début: ".$annonce->getDateDebut()."<br>
    Date de fin: ".$annonce->getDateFin()."<br> Description: ".$annonce->getDescription().
    $annonce->getUtilisateur()->getPseudo()."</p><br>";
}

