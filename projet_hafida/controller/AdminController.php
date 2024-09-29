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

    // On crée une instance de la classe UtilisateurManager pour gérer les opérations sur les utilisateurs
    $utilisateurManager = new UtilisateurManager();
    // On appelle la méthode findAll() pour récupérer tous les utilisateurs de la base de données
    // Cette méthode retourne un tableau contenant tous les utilisateurs
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

//METHODE POUR LISTER TOUTES LES ANNONCES

public function AllAnnonces() {
    // Vérifie si l'utilisateur est connecté et a le rôle "ROLE_ADMIN"
    $utilisateur = Session::getUtilisateur();
    if (!$utilisateur || !$utilisateur->hasRole("ROLE_ADMIN")) {
        Session::addFlash('error', 'Accès refusé. Vous devez être administrateur pour voir cette page.');
        header('Location: index.php?ctrl=security&action=login');
        exit;
    }

    // On crée une instance de la classe AnnonceManager qui gère les annonces
    $annonceManager = new AnnonceManager();
    // On récupère toutes les annonces en appelant la méthode findAll() de AnnonceManager
    $annonces = $annonceManager->findAll();

    return [
        'view' => VIEW_DIR . 'admin/allAnnonces.php',
        "meta_description" => "Toutes les annonces",
        "data" => [
            "annonces" => $annonces
        ]
    ];
}

//METHODE POUR SUPPRIMER UN UTILISATEUR

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
        // Instanciation de la classe ReserverManager qui gère les réservations
        $reserverManager = new ReserverManager(); 
        // Appel de la méthode deleteByUserId pour supprimer toutes les réservations associées à l'utilisateur spécifié par $utilisateurId
        $reserverManager->deleteByUserId($utilisateurId); 
        
        // On essaye de supprimer l'utilisateur en utilisant l'identifiant fourni.
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


//METHODE POUR EDITER UNE ANNONCE
public function editAnnonce() {
    $utilisateur = Session::getUtilisateur();
    
    // On vérifie si l'utilisateur a le rôle "ROLE_ADMIN
        if (!$utilisateur || !$utilisateur->hasRole("ROLE_ADMIN")) {
        Session::addFlash('error', 'Accès refusé. Vous devez être administrateur pour effectuer cette action.');
        header('Location: index.php?ctrl=security&action=login');
        exit;
    }

    // Vérifie si le paramètre 'id' existe dans la requête GET
    if (isset($_GET['id'])) {
        // Récupère l'identifiant de l'annonce depuis la requête GET
        $annonceId = $_GET['id'];
         // Crée une instance de la classe AnnonceManager pour gérer les annonces
        $annonceManager = new AnnonceManager();
        // Utilise la méthode findOneById pour trouver une annonce par son identifiant
        // et stocke le résultat dans la variable $annonce
        $annonce = $annonceManager->findOneById($annonceId);
        
        // Si l'annonce n'existe pas, redirection
        if (!$annonce) {
            Session::addFlash('error', "Annonce introuvable.");
            header('Location: index.php?ctrl=admin&action=AllAnnonces');
            exit;
        }

        // Si le formulaire a été soumis, on traite les données
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updatedData = [
                'nbChat' => $_POST['nbChat'],
                'dateDebut' => $_POST['dateDebut'],
                'dateFin' => $_POST['dateFin'],
                'description' => $_POST['description'],
                'estValide' => $_POST['estValide'] ? 1 : 0 
            ];

            // Tente de mettre à jour l'annonce avec l'ID spécifié en utilisant les nouvelles données fournies.
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
