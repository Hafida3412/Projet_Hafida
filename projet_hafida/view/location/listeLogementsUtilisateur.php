<?php
$logements = $result["data"]['logements']; 
?>


<h1>Mes logements</h1>

<div class="details-container">
    <div class="bg_details">

    <?php
    // Vérifiez si le tableau de logements est vide
    if (empty($logements)) {
        echo "<p>Aucun logement disponible.</p>";
    } else {
        foreach ($logements as $logement) {
            // Afficher les détails du logement
            echo "<div class='annonce-info'>";
            echo "<h2>Référence : " . htmlspecialchars($logement->getId()) . "</h2>";
            echo "<p><strong>Type de logement:</strong> " . htmlspecialchars($logement->getTypeLogement()->getNomType()) . "</p>";
            echo "<p><strong>Nombre de chambres:</strong> " . htmlspecialchars($logement->getNbChambre()) . "</p>";
            echo "<p><strong>Ville:</strong> " . htmlspecialchars($logement->getVille()) . "</p>";
            echo "<div class='logement-image'><img src='" . htmlspecialchars($logement->getImage()) . "' alt='Image du logement' class='annonce-info-img'></div>";
           
            // Formulaire de suppression du logement
            echo "<form method='post' action='index.php?ctrl=location&action=supprimerLogement&id=" . $logement->getId() . "' class='no-background'>"; // Ajout de la classe "no-background"
            echo "<button class='btn-delete-logement button-button' type='submit' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce logement ?')\">Supprimer mon logement</button>";
            echo "</form>";
            
            echo "</div>"; 
        }
    }
    ?>
    </div>
</div>

