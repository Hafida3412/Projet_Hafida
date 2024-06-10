<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UtilisateurManager;
use Model\Managers\LogementManager;

class HomeController extends AbstractController implements ControllerInterface {

    public function index(){
        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Page d'accueil du forum"
        ];
    }
        
    public function users(){
        $this->restrictTo("ROLE_USER");

        $manager = new UtilisateurManager();
        $users = $manager->findAll(['register_date', 'DESC']);

        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs",
            "data" => [ 
                "utilisateurs" => $users 
            ]
        ];
    }

    public function listLogements(){
        $manager = new LogementManager();
        $logements = $manager->findAll(['id_logement', 'DESC']);

        return [
            "view" => VIEW_DIR."logements.php",
            "meta_description" => "Liste de tous les logements",
            "data" => [
                "logements" => $logements
            ]
        ];
    }
}

