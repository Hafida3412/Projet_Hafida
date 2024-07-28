<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\AnnonceManager;
use Model\Managers\ReserverManager;

class ReservationsController extends AbstractController implements ControllerInterface{
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
            // Message d'erreur si l'annonce est déjà réservée
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
        
                // Redirection vers la confirmation de réservation
                $this->redirectTo("reservations", "confirmation");
            }
        }
        
        return [
            "view" => VIEW_DIR . "location/reservation.php",
            "meta_description" => "Formulaire de réservation"
        ];
        
    }

    public function confirmation(){
        
                return [
                    "view" => VIEW_DIR . "location/confirmation.php",
                    "meta_description" => "Confirmation de réservation",
                ];
            
        }
    }
    
    