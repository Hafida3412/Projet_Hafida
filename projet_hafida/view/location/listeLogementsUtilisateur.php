<?php
 $logements = $result["data"]['logements']; 
 ?>
<?php
foreach($logements as $logement){
    // Afficher les détails du logement, par exemple :
    echo "ID : ".$logement->getId()."<br>";
    echo "Nombre de chambres : ".$logement->getNbChambre()."<br>";
    echo "Rue : ".$logement->getRue()."<br>";
    echo "CP : ".$logement->getCP()."<br>";
    echo "Ville : ".$logement->getVille()."<br>";
    echo "Image : <img src='".$logement->getImage()."' alt='Image du logement'><br><br>";
}
