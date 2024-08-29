<?php
namespace Controller;

use App\AbstractController;
use App\Session;
use Model\Managers\AnnonceManager;
use Model\Managers\UtilisateurManager;


class AdminController extends AbstractController{

//FONCTION POUR LISTER TOUS LES UTILISATEURS

public function listUtilisateurs() {
    // Vérifie si l'utilisateur est connecté
    $utilisateur = Session::getUtilisateur();
    
    // Si l'utilisateur n'est pas connecté ou n'a pas le rôle "ROLE_ADMIN"
    if (!$utilisateur || !$utilisateur->hasRole("ROLE_ADMIN", "Admin")){
        // Rediriger vers la page de connexion si l'utilisateur n'est pas admin
        Session::addFlash('error', 'Accès refusé. Vous devez être administrateur pour voir cette page.');
        header('Location: index.php?ctrl=security&action=login');
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