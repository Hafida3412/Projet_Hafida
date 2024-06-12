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
    

    //AJOUTER/DEPOSER UNE ANNONCE
    public function ajoutAnnonces($id){

        $annonceManager = new AnnonceManager();

        if(isset($_POST["submitAnnonce"])){
            $dateDebut = (filter_input(INPUT_POST, 'dateDebut', FILTER_SANITIZE_SPECIAL_CHARS));
            $dateFin = (filter_input(INPUT_POST, 'dateFin', FILTER_SANITIZE_SPECIAL_CHARS));
            $typeLogement = (filter_input(INPUT_POST, 'typeLogement', FILTER_SANITIZE_SPECIAL_CHARS));
            $nbChambre = (filter_input(INPUT_POST, 'nbChambre', FILTER_VALIDATE_INT));
            $nbChat = (filter_input(INPUT_POST, 'nbChat', FILTER_VALIDATE_INT));
            $description = (filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS));
        
        // On vérifie que toutes les données nécessaires sont présentes
        if($dateDebut && $dateFin && $typeLogement && $nbChambre && $nbChat && $description){
        $annonceManager->add([
            "dateDebut" => $dateDebut,
            "dateFin"  => $dateFin,
            "typeLogement" => $typeLogement,
            "nbChambre"  => $nbChambre,
            "nbChat"  => $nbChat,
            "description"  => $description,
            //ON AJOUTE EGALEMENT L UTILISATEUR QUI CREE LE SUJET
            "utilisateur_id" => Session::getUtilisateur()->getId(),//ça reprend le fichier session/ on écrit Session :: car ça reprend la session "static" utilisateur
            "logement_id"=> $id
        ]);
        // Rediriger après l'ajout de l'annonce
        $this->redirectTo("forum", "index", $id);
        }

    }
         // Afficher le formulaire de dépôt d'annonce
        return [
        "view" => VIEW_DIR."forum/ajoutAnnonces.php",
        "meta_description" => "Déposer une annonce"
    ];
        }    
    }

    


    



 



