<?php
namespace Controller;

use App\AbstractController;
use App\Session;
use Model\Managers\AnnonceManager;
use Model\Managers\UtilisateurManager;
use SessionHandler;

class AdminController extends AbstractController{

//FONCTION POUR LISTER TOUS LES UTILISATEURS

public function listUtilisateurs() {
    // On vérifie si l'utilisateur est connecté et s'il a le rôle "ROLE_ADMIN"
    if (!Session::getUtilisateur() || !Session::getUtilisateur()->hasRole("ROLE_ADMIN")) {
        header('Location: index.php?ctrl=security&action=login'); // Rediriger vers la page de connexion si l'utilisateur n'est pas admin
        exit;
    }

    // On récupère tous les utilisateurs
    $utilisateurManager = new UtilisateurManager();
    $utilisateurs = $utilisateurManager->findAll();

    // On retourne la vue et les données
    return [
        'view' => VIEW_DIR . 'admin/listUtilisateurs.php',
        "meta_description" => "Liste des Utilisateurs",
        "data" => [
            "utilisateurs" => $utilisateurs
        ]
    ];
}

}