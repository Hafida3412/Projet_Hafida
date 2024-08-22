<?php
namespace Controller;

use App\AbstractController;
use App\Session;
use Model\Managers\AnnonceManager;
use Model\Managers\UtilisateurManager;

class AdminController extends AbstractController{

    public function annonces(){
        $this->restrictTo("ROLE_ADMIN");

        $annonceManager = new AnnonceManager();
        $annonces = $annonceManager->findAll();

        return [
            "view" => VIEW_DIR."admin/annonces.php",
            "meta_description" => "Liste de toutes les annonces",
            "data" => [
                "annonces" => $annonces
            ]
        ];
    }

    public function utilisateurs(){
        $this->restrictTo("ROLE_ADMIN");

        $userManager = new UtilisateurManager();
        $utilisateurs = $userManager->findAll();
        
        return [
            "view" => VIEW_DIR."admin/utilisateurs.php",
            "meta_description" => "Liste de tous les utilisateurs",
            "data" => [
                "utilisateurs" => $utilisateurs
            ]
        ];
    }
}