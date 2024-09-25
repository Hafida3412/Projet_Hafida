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
use Model\Managers\ImageManager;
use App\DAO; 

class LocationController extends AbstractController implements ControllerInterface{

// FONCTION POUR LISTER TOUTES LES ANNONCES

public function index($id = null) {
    // Création d'une instance de AnnonceManager pour gérer les annonces
    $annonceManager = new AnnonceManager();

    // Récupération du numéro de la page courante à partir des paramètres GET, par défaut à 1
    $pageNum = isset($_GET['page']) ? (int)$_GET['page'] : 1;

     // Définition du nombre d'annonces à afficher par page
    $perPage = 3;

    // Comptage total des annonces via la méthode countAll() de AnnonceManager
    $totalAnnonces = $annonceManager->countAll();
    
    // Vérification que le résultat de countAll() est bien un entier
    if (!is_int($totalAnnonces)) {
        throw new \Exception("countAll() devait retourner un entier, mais a retourné: " 
        . gettype($totalAnnonces));
    }

    // Calcul du nombre total de pages nécessaires pour afficher toutes les annonces
    $totalPages = ceil($totalAnnonces / $perPage);

    // Calcul de l'offset (décalage) pour la requête de recherche d'annonces
    $offset = ($pageNum - 1) * $perPage;

     /* Récupération des annonces pour la page courante en utilisant un tri par date de création 
     et en appliquant l'offset et la limite*/
    $annonces = $annonceManager->findAll(["dateCreation", "DESC"], $offset, $perPage);

    return [
        "view" => VIEW_DIR . "location/listAnnonces.php", // Chemin vers la vue des annonces
        "meta_description" => "Liste des annonces", // Description à utiliser pour le SEO
        "data" => [  // Données à passer à la vue
            "annonces" => $annonces, // Annonces récupérées pour la page
            "page" => $pageNum, // Numéro de la page courante
            "totalPages" => $totalPages, // Nombre total de pages
            "id" => $id, // ID passé en paramètre, s'il existe
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
    // Message à afficher si aucune annonce n'est trouvée
       $message = null;
       if (empty($annonces)) {
       $message = "Aucune annonce trouvée pour la ville : " . htmlspecialchars($ville);
    }

    return [
        "view" => VIEW_DIR . "location/listAnnonces.php",
        "meta_description" => "Liste des annonces",
        "data" => [ // Données à passer à la vue
            "annonces" => $annonces,
            "message" => $message, // On passe le message à la vue
        ]
    ];
}
        
    
//FONCTION POUR AFFICHER LES DETAILS DES ANNONCES

    public function detailsAnnonce($id) {
        $annonceManager = new AnnonceManager(); //création d'une instance de la classe AnnonceManager pour gérer les annonces.
        $annonce = $annonceManager->findOneById($id); //on récupère l'annonce correspondant à l'identifiant passé en parametre 
    
        if (!$annonce) {
            // Si l'annonce n'existe pas, vous pouvez gérer l'erreur en affichant un message ou en redirigeant
            Session::addFlash("error", "Annonce introuvable.");
            $this->redirectTo("location", "index");
            return; // important de sortir de la fonction après la redirection
        }
    
        // On peut maintenant récupérer le logement lié à l'annonce
        $logementManager = new LogementManager();
        $logement = $logementManager->findOneById($annonce->getLogement()->getId());
    
        if (!$logement) {
            // Erreur: le logement avec cet id n'existe pas
            Session::addFlash("error", "Logement introuvable.");
            $this->redirectTo("location", "index"); 
            return; // important de sortir de la fonction après la redirection
        }
    
        // Création de l'instance de la classe ImageManager pour gérer les images
        $imageManager = new ImageManager();
        $images = $imageManager->findImagesByLogement($logement->getId()); // On récupère les images en utilisant cette méthode qui est dans ImageManager
    
        // On récupère les avis
        $avisManager = new AvisManager();
        $avis = $avisManager->findAvisByLogement($logement->getId()); 

        return [
            "view" => VIEW_DIR . "location/detailsAnnonce.php",
            "meta_description" => "Détails de l'annonce",
            "data" => [ // Données à passer à la vue
                "annonce" => $annonce,
                "logement" => $logement,
                "images" => $images, // On passe les images à la vue
                "avis" => $avis,
            ]
        ];
    }
    
    
//AJOUTER/DEPOSER UNE ANNONCE

    public function ajoutAnnonces() {
    // création de l'instance de la classe logementManager pour gérer les logements.
        $logementManager = new LogementManager();
    // on récupère l'id de l'utilisateur connecté
        $id = Session::getUtilisateur()->getId();
    // on récupère les logements par utilisateur en utilisant la requête créée dans logementManager
        $logements = $logementManager->listLogementsByUser($id);
    
        if (Session::getUtilisateur()) { // On vérifie si l'utilisateur est connecté
            $annonceManager = new AnnonceManager(); // Si oui, on crée une instance de annonceManager pour gérer les annonces
    
            // On filtre les champs du formulaire d'ajout d'annonce
            if (isset($_POST["submitAnnonce"])) {
                $dateDebut = filter_input(INPUT_POST, 'dateDebut', FILTER_SANITIZE_SPECIAL_CHARS);
                $dateFin = filter_input(INPUT_POST, 'dateFin', FILTER_SANITIZE_SPECIAL_CHARS);
                $nbChat = filter_input(INPUT_POST, 'nbChat', FILTER_VALIDATE_INT);
                $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
                $id_logement = filter_input(INPUT_POST, 'logements', FILTER_SANITIZE_SPECIAL_CHARS);
    
                // On vérifie que toutes les données nécessaires sont présentes
                if ($dateDebut && $dateFin && $nbChat && $description && $id_logement) {
                    // Vérification que la date de début n'est pas dans le passé
                    $currentDate = date("Y-m-d"); 
                    if ($dateDebut < $currentDate) {
                        Session::addFlash("error", "La date de début ne peut pas être antérieure à aujourd'hui.");
                        return $this->redirectTo("location", "ajoutAnnonces");
                    }
    
                    // Vérification que la date de fin est supérieure ou égale à la date de début
                    if ($dateFin < $dateDebut) {
                        Session::addFlash("error", "La date de fin doit être postérieure ou égale à la date de début.");
                        return $this->redirectTo("location", "ajoutAnnonces");
                    }
                    
                    // On insère l'annonce dans la BDD grâce à la fonction "add" du fichier Manager
                    $annonceManager->add([
                        "dateDebut" => $dateDebut,
                        "dateFin" => $dateFin,
                        "nbChat" => $nbChat,
                        "description" => $description,
                        "utilisateur_id" => Session::getUtilisateur()->getId(),
                        "logement_id" => $id_logement // on rajoute l'id du logement
                    ]);
                    
                    // Ajout d'un message de succès
                    Session::addFlash("success", "Votre annonce a été déposée avec succès.");
    
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
        // Ajout de message flash
            Session::addFlash("success", "Votre logement a été créé avec succès.");
                
        // Redirection vers la page de dépôt d'annonce après l'ajout
            return $this->redirectTo("location", "ajoutAnnonces");
            }
        }
        
        // Retour des informations nécessaires pour la vue de création de logement
            return [
                "view" => VIEW_DIR."location/creationLogement.php",
                "meta_description" => "Création d'un logement",
                "data" => []
            ];
        }

//LISTE DE LOGEMENTS PAR UTILISATEUR

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
            "data" => [ // Données à passer à la vue
                "logements" => $logements
            ]
        ];
    }

//SUPPRIMER UNE ANNONCE D UN UTILISATEUR
    public function supprimerAnnonce($id){
    //On récupère l'annonce à supprimer
        $annonceManager = new annonceManager();
        $annonce = $annonceManager->findOneById($id);;

        if(Session::getUtilisateur()) {
    // Vérifiez si l'id de l'utilisateur de l'annonce = id de l'utilisateur connecté 
            if(Session::getUtilisateur()->getId() == $annonce->getUtilisateur()->getId()) {
    // Supprimer d'abord les réservations associées
                $annonceManager->deleteReservations($id);
    // Ensuite, on supprime l'annonce
                $annonceManager->deleteAnnonce($id);
                $this->redirectTo("location", "index", $annonce->getLogement()->getId());
            }  
            return [
                "view" => VIEW_DIR."location/listAnnonces.php", 
                "data" => [ // Données à passer à la vue
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
        // Récupération des avis
        $avisManager = new AvisManager();
        $avis = $avisManager->findAvisByLogement($id); // On récupére les avis par logement
                
        // On ajoute l'avis en base de données
        $avisManager->add([
            "dateAvis" => date("Y-m-d H:i:s"),
            "commentaire" => $commentaire,
            "logement_id" => $annonce->getLogement()->getId(), // On lie l'avis au logement de l'annonce
            "utilisateur_id" => Session::getUtilisateur()->getId() // On lie l'avis à l'utilisateur connecté
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
                "annonce_id" => $id,
            ]
        ];
    }

//FONCTION CONTACT

    public function contact() {
        return [
            "view" => VIEW_DIR . "location/contact.php",
            "meta_description" => "Nous contacter",
        ];
    }

//FONCTION FAQ

    public function FAQ() {
        return [
            "view" => VIEW_DIR . "location/FAQ.php",
            "meta_description" => "Foire aux Questions",
        ];
    }

//FONCTION MENTIONS LEGALES

    public function MentionsLegales() {
        return [
            "view" => VIEW_DIR . "location/mentionsLegales.php",
            "meta_description" => "Mentions Légales",
        ];
    }

//FONCTION REGLEMENT

    public function Reglement() {
        return [
            "view" => VIEW_DIR . "location/reglement.php",
            "meta_description" => "Règlement de notre site",
        ];
    }    

//CREATION DE LA FONCTION UPLOAD IMAGE
   
    public function uploadImage($annonce_id) {
        $annonceManager = new AnnonceManager();
        $imageManager = new ImageManager();
    
        // On vérifie que l'annonce existe en récupérant les détails via l'ID
        $annonce = $annonceManager->findOneById($annonce_id);
        if (!$annonce) {
        //Si l'annonce n'est pas trouvée, on ajoute un message d'erreur à la session
            Session::addFlash("error", "Annonce introuvable.");
        // On redirige vers la page d'index des annonces
            $this->redirectTo("location", "index");
            return;// On termine l'exécution de cette fonction
        }
    
        // On vérifie si un fichier a été soumis
        if (isset($_FILES['file'])) {
        // On récupére des informations sur le fichier téléchargé
            $tmpName = $_FILES['file']['tmp_name']; // Chemin temporaire du fichier
            $name = $_FILES['file']['name']; // Nom original du fichier
            $size = $_FILES['file']['size']; // Taille du fichier
            $error = $_FILES['file']['error']; // Erreur, s'il y en a une
            $type = $_FILES['file']['type']; // Type du fichier

    
            // Extraction de l'extension du fichier
            $tabExtension = explode('.', $name);  // Séparation du nom en utilisant le point comme séparateur
            $extension = strtolower(end($tabExtension)); // Récupération la dernière partie (extension) et écriture en minuscules
    
            // Liste des extensions autorisées pour le téléchargement
            $extensionsAutorisees = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
            $tailleMax = 4000000; // // Taille maximale en bytes (4 Mo)
    
            // Vérification des conditions : extension autorisée, taille acceptable, et pas d'erreur
            if (in_array($extension, $extensionsAutorisees) && $size <= $tailleMax && $error == 0) {
            // Génération d'un nom de fichier unique pour éviter les collisions
                $uniqueName = uniqid('', true);
                $fileName = $uniqueName . '.' . $extension; // Création du nom de fichier complet

                // Déplacement du fichier téléchargé vers le répertoire de destination
                if (move_uploaded_file($tmpName, './public/upload/' . $fileName)) {
                // Insertion des informations sur l'image dans la base de données
                    $imageManager->add([
                        "nomImage"=> $fileName, // Nom du fichier
                        "altImage" => $annonce->getLogement()->getVille(), // Texte alternatif, basé sur la ville du logement
                        "logement_id" => $annonce->getLogement()->getId() // ID du logement associé à l'annonce
                    ]);
                }
            }
        }
    
        //Redirection vers la vue detailsAnnonce
        $this->redirectTo("location", "detailsAnnonce", $annonce_id);
    }
    
}