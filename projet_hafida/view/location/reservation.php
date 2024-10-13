<?php  
 // Récupère l'ID de l'annonce à partir des données de réponse
  $annonceId = $result["data"]['annonceId']; 
?>
<div class="bg_reservation">
<h1>Réservation</h1>

<!-- Formulaire de réservation avec méthode POST -->
<form action="index.php?ctrl=reservations&action=reservation&annonceId=<?= $annonceId?>" method="POST">
    
    <!-- Champ pour le nom -->
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" required><br>

    <!-- Champ pour le prénom -->
    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" id="prenom" required><br>

    <!-- Champ pour le numéro de téléphone -->
    <label for="numeroTelephone">Numéro de téléphone</label>
    <input type="text" name="numeroTelephone" id="numeroTelephone" required><br>

    <!-- Champ pour le nombre d'adultes -->
    <label for="nbAdultes">Nb d'adultes</label>
    <input type="number" name="nbAdultes" min="1" required><br>

    <!-- Champ pour le nombre d'enfants -->
    <label for="nbEnfants">Nb d'enfants</label>
    <input type="number" name="nbEnfants"  min="0" required><br>

    <div class="paiement">
        <!-- Section pour choisir le mode de paiement -->
        <label for="paiement">Mode de Paiement:</label>
        <input type="radio" id="cb" name="paiement" value="cb">
        <label for="cb">Carte Bancaire (Visa, Mastercard)</label>
        <input type="radio" id="paypal" name="paiement" value="paypal">
        <label for="paypal">PayPal</label>
    </div>
    
    <!-- Champ pour les demandes particulières -->
    <label for="question">Avez-vous une demande particulière?</label>
    <textarea name="question" rows="4" cols="50"></textarea><br>
    
    <!-- Bouton de soumission pour la réservation -->
    <input type="submit" name="submitReservation" class="btn-reservation" value="Réserver">
</form>
</div>