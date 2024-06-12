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
        $annonceManager = new AnnonceManager();//création d'une instance de la classe AnnonceManager pour gérer les annonces.
        $annonce = $annonceManager->findOneById($id);//on récupère l'annonce correspondant à l'identifiant passé en paramètre 
        $logementManager= new LogementManager();
        $logement = $logementManager->findOneById($id);

        $avisManager = new AvisManager();//création de l'instance de la classe AvisManager pour gérer les avis.
        $avis = $avisManager->findAvisByLogement($id);// on récupère les avis associés à l'annonce (cf annonceManager)
        
        return [
            "view" => VIEW_DIR."forum/detailsAnnonce.php",
            "meta_description" => "Détails de l'annonce",
            "data" => [
                "annonce" => $annonce,
                "logement" => $logement,
                "avis" => $avis
            ]
        ];
    }  

    public function addAnnonces($id){
        
    }
}


 



