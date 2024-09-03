<?php
$logements = $result["data"]['logements']; 
?>
<?php
// Vérifiez si le tableau de logements est vide
if (empty($logements)) {
    echo "<p>Aucun logement disponible.</p>";
} else {
foreach($logements as $logement){
    // Afficher les détails du logement
    echo "<div class='logement-info'>";
    echo "<p>ID : ".$logement->getId()."</p>";
    echo "<p>Nombre de chambres : ".$logement->getNbChambre()."</p>";
    echo "<p>Rue : ".$logement->getRue()."</p>";
    echo "<p>CP : ".$logement->getCP()."</p>";
    echo "<p>Ville : ".$logement->getVille()."</p>";
    echo "<div class='logement-image'><img src='".$logement->getImage()."' alt='Image du logement'></div>";
    echo "</div>";
}
}
?> 

