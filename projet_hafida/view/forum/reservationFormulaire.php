<h1>Réservation</h1>
<form action="index.php?ctrl=forum&action=reservation" method="post">
    
    <label for="nom">Nom</label>
    <input type="text" name="nom"><br>

    <label for="prenom">Prénom</label>
    <input type="text" name="prenom"><br>

    <label for="rue">Rue</label>
    <input type="text" name="rue"><br>
    
    <label for="codePostal">Code Postal</label>
    <input type="text" name="codePostal"><br>

    <label for="ville">Ville</label>
    <input type="text" name="ville"><br>

    <label for="numeroTelephone">Numéro de téléphone</label>
    <input type="text" name="numeroTelephone" id="numeroTelephone"><br>

    <label for="email">Email</label>
    <input type="text" name="email" id="email"><br>

    <label for="paiement">Mode de Paiement:</label><br>
    <input type="radio" id="cb" name="paiement" value="cb">
    <label for="cb">Carte Bancaire (Visa, Mastercard)</label><br>
    <input type="radio" id="paypal" name="paiement" value="paypal">
    <label for="paypal">PayPal</label><br>

    <label for="question">Avez-vous une demande particulière?</label>
    <textarea name="question" rows="4" cols="50"></textarea><br>

    <input type="submit" name="submitReservation" value="Réserver">
</form>