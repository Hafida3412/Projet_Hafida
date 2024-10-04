<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\AnnonceManager;
use Model\Managers\ReserverManager;

class ReservationsController extends AbstractController implements ControllerInterface{

//FONCTION DE RESERVATION D UNE ANNONCE

    public function reservation(){ // On vérifie que l'utilisateur est connecté
         if (!Session::getUtilisateur()) {
             // Redirection vers la page de connexion si l'utilisateur n'est pas connecté 
             $this->redirectTo("connexion", "login"); 
             return; 
        }
             
        // On récupère l'ID de l'annonce via GET
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
        // Instanciation du manager pour vérifier la validité de l'annonce
        // On vérifie si l'annonce est déjà réservée
            $annonceManager = new AnnonceManager();
            $estValide = $annonceManager->isAnnonceValide($annonceId);
        //var_dump($estValide);die;
        
        // Si l'annonce est déjà réservée, afficher un message d'erreur
             if($estValide){
        // Message d'erreur si l'annonce est déjà réservée
             Session::addFlash("error", "Cette annonce est déjà réservée.");
             $this->redirectTo("location", "index");
            return;
        }

        // Filtrage et nettoyage des données du formulaire
            $numeroTelephone = filter_input(INPUT_POST, "numeroTelephone", FILTER_SANITIZE_SPECIAL_CHARS);
            $nbAdultes = filter_input(INPUT_POST, "nbAdultes", FILTER_VALIDATE_INT);
            $nbEnfants = filter_input(INPUT_POST, "nbEnfants", FILTER_VALIDATE_INT);
            $paiement = filter_input(INPUT_POST, "paiement", FILTER_SANITIZE_SPECIAL_CHARS);
            $question = filter_input(INPUT_POST, "question", FILTER_SANITIZE_SPECIAL_CHARS);
        //$annonceId = filter_input(INPUT_GET, "annonceId", FILTER_VALIDATE_INT);
        //var_dump($_GET['id']);die;
            $valide = 1; // Réservation validée
        //var_dump($numeroTelephone, $nbAdultes, $nbEnfants, $paiement, $question);die;
   
        // Vérification de la validité des données fournies
            if ($numeroTelephone && $nbAdultes !== false && $nbEnfants !== false && $paiement)  {
        //Enregistrement des informations de la réservation dans la base de données
             $reserverManager = new ReserverManager();
            /* $result=*/ $reserverManager->add([
            "numeroTelephone" => $numeroTelephone,
            "nbAdultes" => $nbAdultes,
            "nbEnfants" => $nbEnfants,
            "paiement" => $paiement,
            "question" => $question,
            "valide" => $valide,
            "annonce_id" => $annonceId,
            "utilisateur_id" => Session::getUtilisateur()->getId()
            ]);
        //var_dump($result);die;

        // Mise à jour du statut de l'annonce pour indiquer qu'elle est fermée
            $annonceManager->updateDisponibilite($annonceId);
        // Ajout d'un message de confirmation pour l'utilisateur
            Session::addFlash("success", "Votre réservation a été effectuée avec succès.");

        // Redirection vers la confirmation de réservation
            $this->redirectTo("reservations", "confirmation");
            return;
    }
}
        // On retourne la vue de réservation avec les données nécessaires
            return [
            "view" => VIEW_DIR . "location/reservation.php",
            "meta_description" => "Formulaire de réservation",
            "data" => [ 
            "annonceId" => $annonceId 
        ]
    ];   
}

 
//FONCTION DE CONFIRMATION

    public function confirmation(){
        return [
        "view" => VIEW_DIR . "location/confirmation.php",
        "meta_description" => "Confirmation de réservation",
        ];
    }
}
    
    