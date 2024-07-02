<?php

?>
<h1>Réservation</h1>
<form action="index.php?ctrl=location&action=reservation" method="post">

    <label for="numeroTelephone">Numéro de téléphone</label>
    <input type="text" name="numeroTelephone" id="numeroTelephone"><br>

    <label for="nbAdultes">Nb d'adultes</label>
    <input type="number" name="nbAdultes"><br>

    <label for="nbEnfants">Nb d'enfants</label>
    <input type="number" name="nbEnfants"><br>

    <label for="paiement">Mode de Paiement:</label><br>
    <input type="radio" id="cb" name="paiement" value="cb">
    <label for="cb">Carte Bancaire (Visa, Mastercard)</label><br>
    <input type="radio" id="paypal" name="paiement" value="paypal">
    <label for="paypal">PayPal</label><br>

    <label for="question">Avez-vous une demande particulière?</label>
    <textarea name="question" rows="4" cols="50"></textarea><br>

    <input type="submit" name="submitReservation" value="Réserver">
</form>