<h1>Réservation</h1>
<form action="index.php?ctrl=forum&action=reservation" method="post">
    <label for="numeroTelephone">Numéro de téléphone</label>
    <input type="text" name="numeroTelephone" id="numeroTelephone"><br>

    <label for="nbAdultes">Nombre d'adultes:</label>
    <input type="number" name="nbAdultes"><br>

    <label for="nbEnfants">Nombre d'enfants:</label>
    <input type="number" name="nbEnfants"><br>

    <label for="paiement">Paiement:</label>
    <input type="text" name="paiement"><br>

    <label for="question">Question spécifique:</label>
    <textarea name="question" rows="4" cols="50"></textarea><br>

    <input type="submit" name="submitReservation" value="Réserver">
</form>