<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\AnnonceManager;
use Model\Managers\LogementManager;
use Model\Managers\UtilisateurManager;
use Model\Managers\Manager;
use Model\Managers\AvisManager;


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

    public function detailsAnnonce($id) {
        $annonceManager = new AnnonceManager();
        $annonce = $annonceManager->findOneById($id);
        
        $avisManager = new AvisManager();
        $avis = $annonceManager->findAvisByAnnonce($id);
        
        return [
            "view" => VIEW_DIR."forum/detailsAnnonce.php",
            "meta_description" => "Détails de l'annonce",
            "data" => [
                "annonce" => $annonce,
                "avis" => $avis
            ]
        ];
    }  

}


 



