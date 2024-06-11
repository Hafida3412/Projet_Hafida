<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\AnnonceManager;
use Model\Managers\LogementManager;
use Model\Managers\UtilisateurManager;
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
    
        return [
            "view" => VIEW_DIR."forum/detailsAnnonce.php",
            "meta_description" => "Détails de l'annonce",
            "data" => [
                "annonce" => $annonce
            ]
        ];
    }
    
    public function listAvisByLogement($id){
        $logementManager = new LogementManager();
        $avisManager = new AvisManager();

        $logement = $logementManager->findOneById($id); // Récupérer les informations sur le logement
        $avis = $avisManager->findAllByLogementId($id); // Modifier cette méthode pour qu'elle récupère les avis par ID de logement

        return [
            "view" => VIEW_DIR."logement/listAvis.php",
            "meta_description" => "Liste des avis pour le logement ".$logement->getNom(),
            "data" => [
                "logement" => $logement,
                "avis" => $avis
            ]
        ];
    }

} 


