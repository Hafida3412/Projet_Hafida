<?php
$utilisateurs = $result["data"]['utilisateurs']; 
?>


<h1>Liste des utilisateurs</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Role</th>
            <th>Nom</th>
            <th>Prénom</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($utilisateurs)): // Assurez-vous que c'est $data['utilisateurs'] ?>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?= $utilisateur->getId() ?></td>
                    <td><?= $utilisateur->getPseudo() ?></td>
                    <td><?= $utilisateur->getEmail() ?></td>
                    <td><?= $utilisateur->getRole() ?></td>
                    <td><?= $utilisateur->getNom() ?></td>
                    <td><?= $utilisateur->getPrenom() ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Aucun utilisateur trouvé.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
