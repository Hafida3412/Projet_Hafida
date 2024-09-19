<?php
namespace Controller;

use App\AbstractController;
use App\Session;
use Model\Managers\AnnonceManager;
use Model\Managers\UtilisateurManager;
use Model\Managers\ReserverManager;


class AdminController extends AbstractController{

//FONCTION POUR LISTER TOUS LES UTILISATEURS

public function listUtilisateurs() {
    // Vérifie si l'utilisateur est connecté
    $utilisateur = Session::getUtilisateur();
    
    // Si l'utilisateur n'est pas connecté ou n'a pas le rôle "ROLE_ADMIN"
    if (!$utilisateur || !$utilisateur->hasRole("ROLE_ADMIN")){
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

// Méthode pour lister toutes les annonces
public function AllAnnonces() {
    // Vérifie si l'utilisateur est connecté et a le rôle "ROLE_ADMIN"
    $utilisateur = Session::getUtilisateur();
    if (!$utilisateur || !$utilisateur->hasRole("ROLE_ADMIN")) {
        Session::addFlash('error', 'Accès refusé. Vous devez être administrateur pour voir cette page.');
        header('Location: index.php?ctrl=security&action=login');
        exit;
    }

    // On récupère toutes les annonces
    $annonceManager = new AnnonceManager();
    $annonces = $annonceManager->findAll();

    return [
        'view' => VIEW_DIR . 'admin/allAnnonces.php',
        "meta_description" => "Toutes les annonces",
        "data" => [
            "annonces" => $annonces
        ]
    ];
}

public function supprimerUtilisateur() {
    // Vérifie si l'utilisateur est connecté et a le rôle "ROLE_ADMIN"
    $utilisateur = Session::getUtilisateur();
    if (!$utilisateur || !$utilisateur->hasRole("ROLE_ADMIN")) {
        Session::addFlash('error', 'Accès refusé. Vous devez être administrateur pour effectuer cette action.');
        header('Location: index.php?ctrl=security&action=login');
        exit;
    }

    // Vérifie si un ID d'utilisateur est passé dans l'URL
    if (isset($_GET['id'])) {
        $utilisateurId = $_GET['id'];
        
        // Création d'un gestionnaire d'utilisateur
        $utilisateurManager = new UtilisateurManager();
        
        // Suppression des réservations associées
        $reserverManager = new ReserverManager(); // Ajoutez cette ligne pour le nouvel objet ReservationManager
        $reserverManager->deleteByUserId($utilisateurId); // Ajoutez cette méthode à ReservationManager
        
        // Suppression de l'utilisateur
        if ($utilisateurManager->delete($utilisateurId)) {
            Session::addFlash('success', 'L\'utilisateur a été supprimé avec succès.');
        } else {
            Session::addFlash('error', 'Erreur lors de la suppression de l\'utilisateur.');
        }
    } else {
        Session::addFlash('error', 'Aucun utilisateur à supprimer.');
    }

    // Redirection après la suppression
    header('Location: index.php?ctrl=admin&action=listUtilisateurs');
    exit;
}

public function editAnnonce() {
    $utilisateur = Session::getUtilisateur();
    
    // Check if the user is admin
    if (!$utilisateur || !$utilisateur->hasRole("ROLE_ADMIN")) {
        Session::addFlash('error', 'Accès refusé. Vous devez être administrateur pour effectuer cette action.');
        header('Location: index.php?ctrl=security&action=login');
        exit;
    }

    // Check if an ID is provided
    if (isset($_GET['id'])) {
        $annonceId = $_GET['id'];
        $annonceManager = new AnnonceManager();
        $annonce = $annonceManager->findOneById($annonceId);
        
        // If the announcement doesn't exist, redirect
        if (!$annonce) {
            Session::addFlash('error', "Annonce introuvable.");
            header('Location: index.php?ctrl=admin&action=AllAnnonces');
            exit;
        }

        // If the form has been submitted, process the data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updatedData = [
                'nbChat' => $_POST['nbChat'],
                'dateDebut' => $_POST['dateDebut'],
                'dateFin' => $_POST['dateFin'],
                'description' => $_POST['description'],
                'estValide' => $_POST['estValide'] ? 1 : 0 // Checkbox as boolean
            ];

            // Call the update method from the manager
            if ($annonceManager->update($annonceId, $updatedData)) {
                Session::addFlash('success', 'Annonce mise à jour avec succès.');
                header('Location: index.php?ctrl=admin&action=AllAnnonces');
                exit;
            } else {
                Session::addFlash('error', 'Erreur lors de la mise à jour de l\'annonce.');
            }
        }

        return [
            'view' => VIEW_DIR . 'admin/editAnnonce.php',
            'meta_description' => 'Éditer l\'annonce',
            'data' => [
                'annonce' => $annonce
            ]
        ];
    } else {
        Session::addFlash('error', 'Aucune annonce à éditer.');
        header('Location: index.php?ctrl=admin&action=AllAnnonces');
        exit;
    }
}

}
