<h1>Contactez notre service client</h1>

<form action="index.php?ctrl=contact&action=send" method="post">
    <label for="nom">Nom:</label><br>
    <input type="text" name="nom" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label for="message">Message:</label><br>
    <textarea name="message" rows="4" cols="50" required></textarea><br><br>

    <input type="submit" value="Envoyer">
</form>
