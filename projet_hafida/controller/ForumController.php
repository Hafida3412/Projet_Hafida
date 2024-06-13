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
    public function ajoutAnnonces(){
        
        $logementManager = new logementManager();//création de l'instance de la classe logementManager pour gérer les logements.
        $id = Session::getUtilisateur()->getId();//on récupère l'id de l'utilisateur connecté
        $logements = $logementManager->listLogementsByUser($id);// on récupère les logements par utilisateur
    
        if(Session::getUtilisateur()) {
            $annonceManager = new AnnonceManager();
        
            //FILTRER LES CHAMPS DU FORMULAIRE D AJOUT D ANNONCE
            if(isset($_POST["submitAnnonce"])){
                $dateDebut = filter_input(INPUT_POST, 'dateDebut', FILTER_SANITIZE_SPECIAL_CHARS);
                $dateFin = filter_input(INPUT_POST, 'dateFin', FILTER_SANITIZE_SPECIAL_CHARS);
                $nbChat = filter_input(INPUT_POST, 'nbChat', FILTER_VALIDATE_INT);
                $description  = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);   
                $id_logement  = filter_input(INPUT_POST, 'logements', FILTER_SANITIZE_SPECIAL_CHARS);   
                
                
                // Vérifiez que toutes les données nécessaires sont présentes
                if($dateDebut && $dateFin && $nbChat && $description && $id_logement){
                
                // Insertion de l'annonce dans la BDD grâce à la fonction "add" du fichier Manager
                    // var_dump("ok");die;
                    $annonceManager->add([
                        "dateDebut" => $dateDebut,
                        "dateFin"  => $dateFin,
                        "nbChat"  => $nbChat,
                        "description"  => $description,
                        // on rajoute l'utilisateur qui crée l'annonce
                        "utilisateur_id" => Session::getUtilisateur()->getId(),
                        "logement_id" => $id_logement// on rajoute l'id du logement
                        ]);
                    //var_dump("ok");die;
                        // Rediriger après l'ajout de l'annonce
                        $this->redirectTo("forum", "index");
                }
            }
        }
    
        // Afficher le formulaire de dépôt d'annonce
        return [
            "view" => VIEW_DIR . "forum/ajoutAnnonces.php",
            "meta_description" => "Déposer une annonce",
            "data" => [
                "logements" => $logements
            ]
        ];
    }


    //SUPPRIMER UNE ANNONCE D UN UTILISATEUR
    public function supprimerAnnonce($id){

        $annonceManager = new annonceManager();
        $annonce = $annonceManager->findOneById($id);;

        // si l'utilisateur est connecté
        if(Session::getUtilisateur()) {
            // si l'id de l'utilisateur de l'annonce = id de l'utilisateur connecté 
            if(Session::getUtilisateur()->getId() == $annonce->getUtilisateur()->getId()) {
                $annonceManager->deleteAnnonce($id);//on récupére la fonction "deleteAnnonce"
                $this->redirectTo("forum", "index", $annonce->getLogement()->getId());
            }  
            return [
                "view" => VIEW_DIR."forum/index.php", 
                "data" => [
                    "annonces" => $annonceManager->findOneById($id)
                ]
            ];
    
        }
    }

    
}

    


    



 



