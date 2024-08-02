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
        
        // On crée une nouvelle instance de AnnonceManager
        $annonceManager = new AnnonceManager();
        // On récupère la liste de toutes les annonces grâce à la méthode findAll de
        // Manager.php (triés par nom)
        $annonces = $annonceManager->findAll(["dateCreation", "DESC"]);

        // le controller communique avec la vue "listAnnonces" (view) pour lui envoyer 
        //la liste des annonces (data)
        return [
            "view" => VIEW_DIR."location/listAnnonces.php",
            "meta_description" => "Liste des annonces",
            "data" => [
                "annonces" => $annonces
            ]
        ];
    }

    //RECHERCHER UNE ANNONCE PAR VILLE
public function rechercheAnnonce() {
    $annonceManager = new AnnonceManager();
    
    // On récupère la valeur de la ville saisie dans le formulaire de recherche
    $ville = filter_input(INPUT_GET, 'ville', FILTER_SANITIZE_SPECIAL_CHARS);

    // On recherche les annonces par ville en utilisant la requête findAnnoncesByVille
    // dans annonceManager
    $annonces = $annonceManager->findAnnoncesByVille($ville);

    return [
        "view" => VIEW_DIR . "location/listAnnonces.php",
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
        
        //création de l'instance de la classe logementManager pour gérer les logements.
        $logementManager = new logementManager();
        //on récupère l'id de l'utilisateur connecté
        $id = Session::getUtilisateur()->getId();
        // on récupère les logements par utilisateur en utilisant la requête créée dans logementManager
        $logements = $logementManager->listLogementsByUser($id);
    
        if(Session::getUtilisateur()) {//On vérifie si l'utilisateur est connecté
            $annonceManager = new AnnonceManager();/* Si oui, on crée une instance de 
            annonceManager pour gérer les annonces*/
        
            //ON FILTRE LES CHAMPS DU FORMULAIRE D AJOUT D ANNONCE
            if(isset($_POST["submitAnnonce"])){
                $dateDebut = filter_input(INPUT_POST, 'dateDebut', FILTER_SANITIZE_SPECIAL_CHARS);
                $dateFin = filter_input(INPUT_POST, 'dateFin', FILTER_SANITIZE_SPECIAL_CHARS);
                $nbChat = filter_input(INPUT_POST, 'nbChat', FILTER_VALIDATE_INT);
                $description  = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);   
                $id_logement  = filter_input(INPUT_POST, 'logements', FILTER_SANITIZE_SPECIAL_CHARS);   
                
                // On vérifie que toutes les données nécessaires sont présentes
                if($dateDebut && $dateFin && $nbChat && $description && $id_logement){
                
                // On insert l'annonce dans la BDD grâce à la fonction "add" du fichier Manager
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
    
        // On affiche le formulaire de dépôt d'annonce
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
        //Instanciation d'un objet LogementManager
        $logementManager = new LogementManager();
        
        //On vérifie si le formulaire de la création d'un logement est soumis
        if(isset($_POST["submitLogement"])) {
            //On récupère et on filtre les données du formulaire
            $nbChambre = filter_input(INPUT_POST, "nbChambre", FILTER_VALIDATE_INT);
            $rue = filter_input(INPUT_POST, "rue", FILTER_SANITIZE_SPECIAL_CHARS);
            $CP = filter_input(INPUT_POST, "CP", FILTER_SANITIZE_SPECIAL_CHARS);
            $ville = filter_input(INPUT_POST, "ville", FILTER_SANITIZE_SPECIAL_CHARS);
            $image = filter_input(INPUT_POST, "image", FILTER_VALIDATE_URL);
            $typeLogement = filter_input(INPUT_POST, "typeLogement", FILTER_VALIDATE_INT);
        
        //On vérifie si toutes les données requises sont présentes
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
                
            // Redirection vers la page de compte utilisateur après ajout du logement
                $this->redirectTo("location", "monCompte");
            }
        }
        
        // Retour des informations nécessaires pour la vue de création de logement
        return [
            "view" => VIEW_DIR."location/creationLogement.php",
            "meta_description" => "Création d'un logement",
            "data" => []
        ];
    }

    public function listeLogementsUtilisateur(){
        // Vérifiez si l'utilisateur est connecté
        if(!Session::getUtilisateur()){
            // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
            return $this->redirectTo("security", "login");
        }

        // Récupérer l'ID de l'utilisateur connecté
        $userId = Session::getUtilisateur()->getId();

        // Créer une instance du manager de logements
        $logementManager = new LogementManager();

        // Récupérer la liste des logements de l'utilisateur connecté
        $logements = $logementManager->listLogementsByUser($userId);

        return [
            "view" => VIEW_DIR."location/listeLogementsUtilisateur.php",
            "meta_description" => "Détails de l'utilisateur et de ses logements",
            "data" => [
                "logements" => $logements
            ]
        ];
    }


    //SUPPRIMER UNE ANNONCE D UN UTILISATEUR
    public function supprimerAnnonce($id){
        //On récupère l'annonce à supprimer
        $annonceManager = new annonceManager();
        $annonce = $annonceManager->findOneById($id);;

        // si l'utilisateur est connecté
        if(Session::getUtilisateur()) {
            // si l'id de l'utilisateur de l'annonce = id de l'utilisateur connecté 
            if(Session::getUtilisateur()->getId() == $annonce->getUtilisateur()->getId()) {
               //On supprime l'annonce
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
    
    
    //CREATION DE LA FONCTION POUR DONNER UN AVIS SUR UNE ANNONCE
    public function donnerAvis($id) {
        // On vérifie si l'utilisateur est connecté
        if(!Session::getUtilisateur()){
            // Message d'erreur si l'utilisateur n'est pas connecté
            Session::addFlash("error", "Veuillez vous connecter pour donner un avis.");
            $this->redirectTo("security", "login");
        }
        
        // On récupère l'annonce à laquelle l'utilisateur souhaite poster un avis
        $annonceManager = new AnnonceManager();//On crée une instance de AnnonceManager pour gérer les annonce
        $annonce = $annonceManager->findOneById($id);// On récupère l'annonce spécifique à partir de son identifiant

        // On filtre le formulaire d'ajout d'avis
        if(isset($_POST["submitAvis"])){
            $commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_SPECIAL_CHARS);

            // On vérifie que le commentaire est présent
            if($commentaire){
                // On crée une nouvelle instance de AvisManager pour gérer les avis
                $avisManager = new AvisManager();
                
                // On ajoute l'avis en base de données
                $avisManager->add([
                    "dateAvis" => date("Y-m-d H:i:s"),
                    "commentaire" => $commentaire,
                    "logement_id" => $annonce->getLogement()->getId(), // Lier l'avis au logement de l'annonce
                    "utilisateur_id" => Session::getUtilisateur()->getId() // Lier l'avis à l'utilisateur connecté
                ]);

                //On affiche un message pour confirmer que l'avis est enregistré
                Session::addFlash("success", "Votre avis a été enregistré.");
                $this->redirectTo("location", "index");
            } else {
                //Ou un message d'erreur
                Session::addFlash("error", "Veuillez saisir un commentaire pour donner un avis.");
                $this->redirectTo("location", "donnerAvis", $id);
            }
        }
        
        // On retourne à la vue pour donner un avis avec les données nécessaires
        return [
            "view" => VIEW_DIR . "location/donnerAvis.php",
            "meta_description" => "Donner un avis sur une annonce",
            "data" => [
                "annonce_id" => $id
            ]
        ];
    }

    public function contact() {
        return [
            "view" => VIEW_DIR . "location/contact.php",
            "meta_description" => "Nous contacter",
        ];
    }

    public function FAQ() {
        return [
            "view" => VIEW_DIR . "location/FAQ.php",
            "meta_description" => "Foire aux Questions",
        ];
    }

    public function MentionsLegales() {
        return [
            "view" => VIEW_DIR . "location/mentionsLegales.php",
            "meta_description" => "Mentions Légales",
        ];
    }

    public function Reglement() {
        return [
            "view" => VIEW_DIR . "location/reglement.php",
            "meta_description" => "Règlement de notre site",
        ];
    }
    
    
}



