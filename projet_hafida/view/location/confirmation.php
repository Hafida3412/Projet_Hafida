<?php
use App\Session;
?>
<h1>Votre réservation est confirmée!</h1>
<br>
<div class="confirmation-container">
<p>Vous allez chez Chouchou à Strasbourg!</p> 
<br>
<p>Veuillez consulter les informations ci-dessous:</p>
<br>
<p>
Nom: <?= Session::getUtilisateur()->getNom() ?><br>
Prénom: <?= Session::getUtilisateur()->getPrenom() ?><br>
Adresse de destination: <br>
Date de début: <br>
Date de fin: <br>
</p>
<br>
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZFtpXQtltulLsfr3eZodTAYqMdwKd7uA-KEvkHBj2duu4hEDI097-6Ia3cwVS3xcbzHk&usqp=CAU" width="300px" height="200px" alt="Image de Chouchou">
<br>
<p>Le montant de la réservation est de: </p>
<br>
<p>Si vous avez des questions ou des modifications à apporter à votre réservation, 
veuillez nous contacter au plus tôt.</p> 
<br>
<p>Nous vous souhaitons un agréable séjour chez Chouchou!</p> 
<br>
<p>L'équipe Chez mon Chat.</p>
<br>
</div>
<?php 