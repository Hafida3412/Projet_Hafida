<?php
namespace Controller;

// Importation des classes nécessaires
use App\Session; // Gestion des sessions utilisateur
use App\AbstractController;// Classe de base pour le contrôle des redirections
use App\ControllerInterface;// Interface pour garantir que le contrôleur implémente certaines méthodes
use Model\Managers\AnnonceManager;// Gestion des annonces
use Model\Managers\ReserverManager;// Gestion des réservations

// Déclaration de la classe ReservationsController qui étend AbstractController et implémente ControllerInterface
class ReservationsController extends AbstractController implements ControllerInterface{
// elle hérite de la classe AbstractController, ce qui signifie qu'elle bénéficie des méthodes et propriétés définies dans la classe parente.
//ex: redirectTo peut être utilisé directement sans réécriture

//METHODE DE RESERVATION D UNE ANNONCE

    public function reservation(){ // On vérifie que l'utilisateur est connecté
        
        if (!Session::getUtilisateur()) {//On appelle la méthode getUtilisateur de la classe Session
            // Redirection vers la page de connexion si l'utilisateur n'est pas connecté 
            $this->redirectTo("connexion", "login");
        }
        
    // On récupère l'identifiant de l'annonce à partir du paramètre GET de l'URL, qui doit être un nombre entier.
        $annonceId = filter_input(INPUT_GET, 'annonceId', FILTER_VALIDATE_INT);
    // var_dump($annonceId); die;
    
    // On vérifie que l'ID de l'annonce est présent
        if ($annonceId === null) {
        // Redirection ou gestion d'erreur si l'ID de l'annonce n'est pas fourni
            Session::addFlash("error", "Aucun ID d'annonce n'a été fourni.");
            $this->redirectTo("location", "index");
            return;
        }
    //var_dump($annonceId);die;

    // Vérification si le formulaire de réservation a été soumis
        if(isset($_POST["submitReservation"])){ 
    // On crée une nouvelle instance de la classe annonceManager 
        $annonceManager = new AnnonceManager();
    // On appelle la méthode isAnnonceValide de l'objet $annonceManager.   
        $estValide = $annonceManager->isAnnonceValide($annonceId);
    // La méthode isAnnonceValide vérifie si l'annonce correspondante à l'id est réservée ou pas.
        //var_dump($estValide);die;
    
        // Si l'annonce est déjà réservée, on affiche un message d'erreur
            if($estValide){
            // Message d'erreur temporaire si l'annonce est déjà réservée
                Session::addFlash("error", "Cette annonce est déjà réservée.");
                return;
            }

    //Les informations fournies par l'utilisateur dans le formulaire sont alors nettoyées 
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS);
            $prenom= filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_SPECIAL_CHARS);
            $numeroTelephone = filter_input(INPUT_POST, "numeroTelephone", FILTER_SANITIZE_SPECIAL_CHARS);
            $nbAdultes = filter_input(INPUT_POST, "nbAdultes", FILTER_VALIDATE_INT);
            $nbEnfants = filter_input(INPUT_POST, "nbEnfants", FILTER_VALIDATE_INT);
            $paiement = filter_input(INPUT_POST, "paiement", FILTER_SANITIZE_SPECIAL_CHARS);
            $question = filter_input(INPUT_POST, "question", FILTER_SANITIZE_SPECIAL_CHARS);
        //$annonceId = filter_input(INPUT_GET, "annonceId", FILTER_VALIDATE_INT);
        //var_dump($_GET['id']);die;
            $valide = 1; // Réservation validée
        //var_dump($numeroTelephone, $nbAdultes, $nbEnfants, $paiement, $question);die;

    // On vérifie la validité des données fournies, qu'elles respectent les conditions établies
        if ($nom && $prenom && $numeroTelephone && $nbAdultes !== false && $nbAdultes > 0 && $nbEnfants !== false && $paiement){
    //Enregistrement des informations de la réservation dans la base de données via $ReserverManager
            $reserverManager = new ReserverManager();
            /* $result=*/ $reserverManager->add([
    //la méthode add prend un tableau associatif comme paramètre qui contient les info relatives à la réservation
            "nom" => $nom,// CLE => VALEUR (= Le nom de la personne effectuant la réservation)
            "prenom" => $prenom,
            "numeroTelephone" => $numeroTelephone,
            "nbAdultes" => $nbAdultes,
            "nbEnfants" => $nbEnfants,
            "paiement" => $paiement,
            "question" => $question,
            "valide" => $valide,
            "annonce_id" => $annonceId,
            "utilisateur_id" => Session::getUtilisateur()->getId()
            ]);
        // var_dump($result);die;

        // Mise à jour du statut de l'annonce pour indiquer qu'elle est réservée
            $annonceManager->updateDisponibilite($annonceId);// appel à la méthode updateDisponibilite() de l'objet $annonceManager.
        // Un message de succès est ajouté à la session
            Session::addFlash("success", "Votre réservation a été effectuée avec succès.");
        // Redirection vers la confirmation de réservation
            $this->redirectTo("reservations", "confirmation");
            return;
        }
        }
    // Si le formulaire n'a pas été soumis, la méthode prépare la vue de réservation, 
    //qui affichera le formulaire correspondant à l'annonce sélectionnée.

        return [
            "view" => VIEW_DIR . "location/reservation.php",
            "meta" => "Formulaire de réservation",
            "title" => "Réservation d'annonce",
            "data" => [ 
            "annonceId" => $annonceId 
            ]
        ];   
}


//FONCTION DE CONFIRMATION

    public function confirmation(){
        return [
        "view" => VIEW_DIR . "location/confirmation.php",
        "meta" => "Confirmation de réservation",
        "title" => "Confirmation de réservation",
        ];
    }
}
    
    