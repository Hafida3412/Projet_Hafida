<?php
namespace Controller;

use App\AbstractController;
use App\Session;
use Model\Managers\AnnonceManager;
use Model\Managers\UtilisateurManager;

class AdminController extends AbstractController{

//FONCTION POUR LISTER TOUS LES UTILISATEURS

public function listUtilisateurs(){
    $utilisateurManager= new UtilisateurManager();

    $utilisateurs = $utilisateurManager->findAll();

    return [
        "view" => VIEW_DIR."location/dashboard.php",
        "meta_description" => "Liste des utilisateurs",
        "data" => [
            "utilisateurs" => $utilisateurs,
            ]
        ];
}

//FONCTION POUR LISTER TOUTES LES ANNONCES
public function index($id = null) {
    
    // On crée une nouvelle instance de AnnonceManager
    $annonceManager = new AnnonceManager();
    
    // Pagination settings
    $pageNum = isset($_GET['page']) ? (int)$_GET['page'] : 1;// Récupère le numéro de page
    $perPage = 3;

    // Récupérer le nombre total d'annonces
    $totalAnnonces = $annonceManager->countAll(); 

   // Calculer le nombre de pages
    $totalPages = ceil(count($totalAnnonces) / $perPage);
    $offset = ($pageNum - 1) * $perPage;// Calcule l'offset pour la requête SQL

    // On récupère les annonces paginées en utilisant la méthode findAll avec la pagination
    $annonces = $annonceManager->findAll(["dateCreation", "DESC"], $offset, $perPage);
    
    // le controller communique avec la vue "listAnnonces" (view) pour lui envoyer la liste des annonces (data) et les informations de pagination
    return [
        "view" => VIEW_DIR."location/listAnnonces.php",
        "meta_description" => "Liste des annonces",
        "data" => [
            "annonces" => $annonces,
            "page" => $pageNum, // Passer le numéro de la page actuelle
            "totalPages" => $totalPages,
            "id" => $id
        ]
    ];
}


}