<?php
namespace Controller;

use App\AbstractController;
use App\Session;
use Model\Managers\AnnonceManager;
use Model\Managers\UtilisateurManager;

class AdminController extends AbstractController{
    
    public function dashboard(){
        $annonceManager = new AnnonceManager();
        $annonces = $annonceManager->findAll();

        // Vérifier si l'utilisateur est connecté en tant qu'administrateur
        if(Session::isAdmin()){
            return [
                "view" => VIEW_DIR."admin/dashboard.php",
                "meta_description" => "Tableau de bord de l'administrateur",
                "data" => [
                    "annonces" => $annonces
                ]
            ];
        } else {
            // Rediriger vers la page de connexion si l'utilisateur n'est pas administrateur
            Session::addFlash("error", "Accès refusé. Vous n'êtes pas autorisé à accéder à cette page.");
            $this->redirectTo("security", "login");
        }
    }

    public function users(){
        $userManager = new UtilisateurManager();
        $users = $userManager->findAll();
        
        return [
            "view" => VIEW_DIR."admin/dashboard.php",
            "meta_description" => "Tableau de bord de l'administrateur",
            "data" => [
                "utilisateurs" => $users
            ]
        ];
    }
}

