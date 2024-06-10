<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\AnnonceManager;
use Model\Managers\LogementManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        
        // créer une nouvelle instance de AnnonceManager
        $annonceManager = new AnnonceManager();
        // récupérer la liste de toutes les annonces grâce à la méthode findAll de Manager.php (triés par nom)
        $annonces = $annonceManager->findAll(["dateCreation", "DESC"]);

        // le controller communique avec la vue "listAnnonces" (view) pour lui envoyer la liste des annonces (data)
        return [
            "view" => VIEW_DIR."forum/listAnnonces.php",
            "meta_description" => "Liste des annonces",
            "data" => [
                "annonces" => $annonces
            ]
        ];
    }

    public function listLogementsByAnnnonce($id) {

        $logemenentManager = new LogementManager();
        $annonceManager = new AnnonceManager();
        $annonce = $annonceManager->findOneById($id);
        $logements = $logementManager->findLogementsByAnnonce($id);

        return [
            "view" => VIEW_DIR."forum/listLogements.php",
            "meta_description" => "Liste des logements par annonce : ".$annonce,
            "data" => [
                "annonce" => $annonce,
                "logements" => $logements
            ]
        ];
    }
}