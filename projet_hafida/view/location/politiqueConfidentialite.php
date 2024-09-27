<?php
// Déclaration des informations sur l'entreprise
$nom_entreprise = "[Nom de l'entreprise]";
$adresse = "[Adresse]";
$num_tel = "[Numéro de téléphone]";
$email = "[Adresse email]";
$num_tva = "[Numéro de TVA]";
$statut = "[Société par actions simplifiée, société à responsabilité limitée, etc.]";
$directeur_pub = "[Nom du directeur]";
$hebergeur = "[Nom de l'hébergeur]";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de Confidentialité - Chez Mon Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Politique de Confidentialité du site "Chez Mon Chat"</h1>

<p><strong>Responsable de traitement :</strong> <?php echo $nom_entreprise; ?></p>
<p><strong>Siège social :</strong> <?php echo $adresse; ?></p>
<p><strong>Numéro de téléphone :</strong> <?php echo $num_tel; ?></p>
<p><strong>Adresse email :</strong> <?php echo $email; ?></p>
<p><strong>Numéro de TVA intracommunautaire :</strong> <?php echo $num_tva; ?></p>
<p><strong>Statut :</strong> <?php echo $statut; ?></p>
<p><strong>Directeur de la publication :</strong> <?php echo $directeur_pub; ?></p>
<p><strong>Hébergeur du site :</strong> <?php echo $hebergeur; ?></p>

<h2>1. Données collectées</h2>
<p>Nous collectons les données personnelles que vous nous fournissez lors de votre inscription sur notre site, notamment votre nom, prénom et adresse email.</p>

<h2>2. Finalités du traitement des données</h2>
<p>Les données collectées ont pour finalité de vous permettre de créer un compte sur notre site et de bénéficier des services que nous offrons. Elles peuvent également être utilisées pour vous envoyer des informations importantes concernant notre service et, si vous le souhaitez, des newsletters.</p>

<h2>3. Durée de conservation des données</h2>
<p>Vos données personnelles seront conservées pendant une durée maximale de 3 ans à compter de votre dernière interaction avec notre site.</p>

<h2>4. Sécurité des données</h2>
<p>Nous nous engageons à protéger vos données personnelles. Elles sont stockées de manière sécurisée et ne seront pas divulguées à des tiers sans votre consentement, sauf si la loi l’exige.</p>

<h2>5. Droits des utilisateurs</h2>
<p>Conformément au Règlement Général sur la Protection des Données (RGPD), vous disposez des droits suivants concernant vos données personnelles :</p>
<ul>
    <li>Droit d'accès : Vous pouvez obtenir confirmation que des données vous concernant sont traitées et demander l'accès à ces données.</li>
    <li>Droit de rectification : Vous pouvez demander la correction de vos données inexactes ou incomplètes.</li>
    <li>Droit à l'effacement : Vous pouvez demander la suppression de vos données dans certaines conditions.</li>
    <li>Droit d'opposition : Vous pouvez vous opposer à tout moment au traitement de vos données pour des raisons liées à votre situation particulière.</li>
</ul>
<p>Pour exercer ces droits, veuillez nous contacter à l'adresse suivante : <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>.</p>

<h2>6. Consentement</h2>
<p>En utilisant le site "Chez Mon Chat", vous consentez à la collecte et au traitement de vos données personnelles conformément aux dispositions légales en vigueur.</p>

<h2>7. Modifications de la politique de confidentialité</h2>
<p>Nous nous réservons le droit de modifier cette politique de confidentialité à tout moment, sans préavis. Il est recommandé de consulter régulièrement cette page pour prendre connaissance de nos mises à jour.</p>

<h2>8. Inscrivez-vous à notre newsletter</h2>
<p>Pour rester informé de nos actualités et offres, vous pouvez vous inscrire à notre newsletter en saisissant votre adresse email ci-dessous :</p>
<form action="newsletter_signup.php" method="post">
    <input type="email" name="email" placeholder="Votre email" required>
    <button type="submit">S'inscrire</button>
</form>

<h2>9. Suivez-nous</h2>
<p>Restez connecté avec nous pour toutes nos actualités et conseils concernant vos animaux de compagnie.</p>

</body>
</html>
