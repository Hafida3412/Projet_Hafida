<div?php  
  
?>
<div class="bg_reservation">
<h1>Réservation</h1>

<form action="index.php?ctrl=reservations&action=reservation$id=<?= $annonceId?>" method="post">

    <label for="numeroTelephone">Numéro de téléphone</label>
    <input type="text" name="numeroTelephone" id="numeroTelephone"><br>

    <label for="nbAdultes">Nb d'adultes</label>
    <input type="number" name="nbAdultes"><br>

    <label for="nbEnfants">Nb d'enfants</label>
    <input type="number" name="nbEnfants"><br>

    <div class="paiement">
    <label for="paiement">Mode de Paiement:</label>
    <input type="radio" id="cb" name="paiement" value="cb">
    <label for="cb">Carte Bancaire (Visa, Mastercard)</label>
    <input type="radio" id="paypal" name="paiement" value="paypal">
    <label for="paypal">PayPal</label></div>
    

    <label for="question">Avez-vous une demande particulière?</label>
    <textarea name="question" rows="4" cols="50"></textarea><br>

    <!-- <label for="annonce">ID de l'annonce: </label>
    <input type="number" name="annonce" value="number"><br> -->
    
    <input type="submit" name="submitReservation" value="Réserver">

</form>
</div>