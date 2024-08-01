<h1>Liste de mes logements</h1>

<?php
$logements = $result["data"]['logements']; 

if($logements){
    foreach($logements as $logement){
        echo "<div class='logement'>";
        echo "<p>Nombre de chambres : ".$logement->getNbChambre()."</p>";
        echo "<p>Adresse : ".$logement->getAdresseComplete()."</p>";
        echo "<img src='".$logement->getImage()."' alt='Image du logement'>";
        echo "</div>";
    }
} else {
    echo "<p>Aucun logement trouvé.</p>";
}
?>
