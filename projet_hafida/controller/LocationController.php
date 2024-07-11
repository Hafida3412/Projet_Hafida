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
use Model\Managers\TypeLogementManager;
use Model\Managers\ReserverManager;
class LocationController extends AbstractController implements ControllerInterface{

    //FONCTION POUR LISTER TOUTES LES ANNONCES
    public function index() {
        
        // créer une nouvelle instance de AnnonceManager
        $annonceManager = new AnnonceManager();
        // récupérer la liste de toutes les annonces grâce à la méthode findAll de Manager.php (triés par nom)
        $annonces = $annonceManager->findAll(["dateCreation", "DESC"]);

        // le controller communique avec la vue "listAnnonces" (view) pour lui envoyer la liste des annonces (data)
        return [
            "view" => VIEW_DIR."location/listAnnonces.php",
            "meta_description" => "Liste des annonces",
            "data" => [
                "annonces" => $annonces
            ]
        ];
    }

    //FONCTION POUR AFFICHER LES DETAILS DES ANNONCES
    public function detailsAnnonce($id) {
        $annonceManager = new AnnonceManager();//création d'une instance de la classe AnnonceManager pour gérer les annonces.
        $annonce = $annonceManager->findOneById($id);//on récupère l'annonce correspondant à l'identifiant passé en paramètre 
        $logementManager= new LogementManager();
        $logement = $logementManager->findOneById($id);

        $avisManager = new AvisManager();//création de l'instance de la classe AvisManager pour gérer les avis.
        $avis = $avisManager->findAvisByLogement($id);// on récupère les avis associés à l'annonce (cf annonceManager)
        
        return [
            "view" => VIEW_DIR."location/detailsAnnonce.php",
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
        
            //ON FILTRE LES CHAMPS DU FORMULAIRE D AJOUT D ANNONCE
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
                        // Redirection après l'ajout de l'annonce
                        $this->redirectTo("location", "index");
                }
            }
        }
    
        // Afficher le formulaire de dépôt d'annonce
        return [
            "view" => VIEW_DIR . "location/ajoutAnnonces.php",
            "meta_description" => "Déposer une annonce",
            "data" => [
                "logements" => $logements
            ]
        ];
    }
    
    //CREATION D UN LOGEMENT
    public function creationLogement() {
        $logementManager = new LogementManager();
               
        if(isset($_POST["submitLogement"])) {
            $nbChambre = filter_input(INPUT_POST, "nbChambre", FILTER_VALIDATE_INT);
            $rue = filter_input(INPUT_POST, "rue", FILTER_SANITIZE_SPECIAL_CHARS);
            $CP = filter_input(INPUT_POST, "CP", FILTER_SANITIZE_SPECIAL_CHARS);
            $ville = filter_input(INPUT_POST, "ville", FILTER_SANITIZE_SPECIAL_CHARS);
            $image = filter_input(INPUT_POST, "image", FILTER_VALIDATE_URL);
            $typeLogement = filter_input(INPUT_POST, "typeLogement", FILTER_VALIDATE_INT);
    
            if($nbChambre && $rue && $CP && $ville && $image && $typeLogement) {
                $logementManager->add([
                    "nbChambre" => $nbChambre,
                    "rue" => $rue,
                    "CP" => $CP,
                    "ville" => $ville,
                    "image" => $image,
                    "typeLogement_id" => $typeLogement,// on rajoute l'id du type de logement
                    // on rajoute l'utilisateur qui crée le logement
                    "utilisateur_id" => Session::getUtilisateur()->getId()
                ]); 
    
                $this->redirectTo("location", "monCompte");
            }
        }
        
        return [
            "view" => VIEW_DIR."location/creationLogement.php",
            "meta_description" => "Création d'un logement",
            "data" => []
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
                $this->redirectTo("location", "index", $annonce->getLogement()->getId());
            }  
            return [
                "view" => VIEW_DIR."location/listAnnonces.php", 
                "data" => [
                    "annonces" => $annonceManager->findOneById($id)
                ]
            ];
        }
    }
    
    //CREATION DE LA FONCTION RESERVATION
    public function reservation(){
        // On vérifie que l'utilisateur est connecté
        if (!Session::getUtilisateur()) {
            // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
            $this->redirectTo("connexion", "login");
            return;
        }

        if(isset($_POST["submitReservation"])){
            $annonceId = $_POST["annonce"];
        
            // On vérifie si l'annonce est déjà réservée
            $annonceManager = new AnnonceManager();
            $estValide = $annonceManager->isAnnonceValide($annonceId);
        
            if($estValide){
                Session::addFlash("error", "Cette annonce est déjà réservée.");
                $this->redirectTo("location", "index");
                return;
            }
        
            // On filtre les données du formulaire
            $numeroTelephone = filter_input(INPUT_POST, "numeroTelephone", FILTER_SANITIZE_SPECIAL_CHARS);
            $nbAdultes = filter_input(INPUT_POST, "nbAdultes", FILTER_VALIDATE_INT);
            $nbEnfants = filter_input(INPUT_POST, "nbEnfants", FILTER_VALIDATE_INT);
            $paiement = filter_input(INPUT_POST, "paiement", FILTER_SANITIZE_SPECIAL_CHARS);
            $question = filter_input(INPUT_POST, "question", FILTER_SANITIZE_SPECIAL_CHARS);
            $annonce = filter_input(INPUT_POST, "annonce", FILTER_VALIDATE_INT);
            $valide = 1; // Réservation validée
        
            // Vérification des données
            if ($numeroTelephone && $nbAdultes !== false && $nbEnfants !== false && $paiement && $annonce !== false) {
                // Enregistrement des informations de la réservation dans la base de données
                $reserverManager = new ReserverManager();
                $reserverManager->add([
                    "numeroTelephone" => $numeroTelephone,
                    "nbAdultes" => $nbAdultes,
                    "nbEnfants" => $nbEnfants,
                    "paiement" => $paiement,
                    "question" => $question,
                    "valide" => $valide,
                    "annonce_id" => $annonce,
                    "utilisateur_id" => Session::getUtilisateur()->getId()
                ]);
        
                // Mise à jour du statut de l'annonce pour indiquer qu'elle est fermée
                $annonceManager->updateDisponibilite($annonce);
        
                // Redirection après l'enregistrement de la réservation
                $this->redirectTo("location", "index");
            }
        }
        
        return [
            "view" => VIEW_DIR . "location/reservation.php",
            "meta_description" => "Formulaire de réservation"
        ];
        
    }

    //ACTION POUR DONNER UN AVIS SUR UNE ANNONCE
public function donnerAvis($id) {
    // Vérification si l'utilisateur est connecté
    if(!Session::getUtilisateur()){
        Session::addFlash("error", "Veuillez vous connecter pour donner un avis.");
        $this->redirectTo("security", "login");
    }
    
    // Récupérer l'annonce à laquelle l'utilisateur souhaite poster un avis
    $annonceManager = new AnnonceManager();
    $annonce = $annonceManager->findOneById($id);

    // Traitement du formulaire d'ajout d'avis
    if(isset($_POST["submitAvis"])){
        $commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_SPECIAL_CHARS);

        // Vérifier que le commentaire est présent
        if($commentaire){
            $avisManager = new AvisManager();
            
            // Ajouter l'avis en base de données
            $avisManager->add([
                "dateAvis" => date("Y-m-d H:i:s"),
                "commentaire" => $commentaire,
                "logement_id" => $annonce->getLogement()->getId(), // Lier l'avis au logement de l'annonce
                "utilisateur_id" => Session::getUtilisateur()->getId() // Lier l'avis à l'utilisateur connecté
            ]);

            Session::addFlash("success", "Votre avis a été enregistré.");
            $this->redirectTo("location", "index");
        } else {
            Session::addFlash("error", "Veuillez saisir un commentaire pour donner un avis.");
            $this->redirectTo("location", "donnerAvis", $id);
        }
    }
    
    return [
        "view" => VIEW_DIR . "location/donnerAvis.php",
        "meta_description" => "Donner un avis sur une annonce",
        "data" => [
            "annonce_id" => $id
        ]
    ];
}

    
}



