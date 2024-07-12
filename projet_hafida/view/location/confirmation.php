<?php

?>

<p>Merci pour votre réservation chez Chouchou à Strasbourg! 
Veuillez consulter les informations ci-dessous:</p>

<ul>
    <li>Nom: </li>
    <li>Prénom: </li>
    <li>Date de début: <?= date('d-m-Y', strtotime($annonce->getDateDebut())) ?></li>
    <li>Date de fin: <?= date('d-m-Y', strtotime($annonce->getDateFin())) ?></li>
    <li>Adresse: </li>
</ul>

<img src="" alt="Image de Chouchou">

<p>Le montant de la réservation est de: </p>

<p>Si vous avez des questions ou des modifications à apporter à votre réservation, 
veuillez nous contacter au plus tôt.</p> 
<p>Nous vous souhaitons un agréable séjour chez Chouchou!</p