<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UtilisateurManager;
use Model\Managers\ReserverManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout
     // Affiche la vue du formulaire register
          //session_start();
    
    //MISE EN PLACE DE LA FONCTION S INSCRIRE
    public function register () {
    
        if (isset($_POST["submitRegister"])) {
             
     //FILTRER LES CHAMPS DU FORMULAIRE D INSCRIPTION:
             $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
             $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
         
     //VERIFIER LA VALIDITE DES FILTRES:
        if($pseudo && $email && $pass1 && $pass2){
 
     //var_dump("ok");die;
             $userManager = new UtilisateurManager();
             $utilisateur = $userManager->checkUserExists($email);//création de la function checkUserExists dans utilisateurManager pour vérifier si l'utilisateur existe
     //SI L UTILISATEUR EXISTE
        if($utilisateur){
             header("Location: index.php?ctrl=security&action=register"); 
        exit; 
        } else {
     //var_dump("utilisateur inexistant");die;
     //insertion de l'utilisateur en BDD
        if($pass1 == $pass2 && strlen($pass1) >= 5) {//VERIFICATION QUE LES MDP SONT IDENTIQUES
                             
                $userManager->add([//on récupère la function add du fichier Manager
                "pseudo" => $pseudo,
                "email" => $email,
                "password" => password_hash($pass1, PASSWORD_DEFAULT)
                 ]
        );
     //REDIRECTION APRES L INSCRIPTION
               header("Location: index.php?ctrl=security&action=login");
        exit;
        } else {
               header("Location: index.php?ctrl=security&action=register");
        exit;
        $this->redirectTo("security","register");
    }   
        }
    }
            } 
        return [
                 "view" => VIEW_DIR . "connexion/login.php",
                 "meta_description" => "Formulaire d'inscription"
            ];
     }  

    //MISE EN PLACE DE LA FONCTION SE CONNECTER
    public function login() {

        if(isset($_POST["submitLogin"])) {
   
    //PROTECTION XSS (=FILTRES)
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($email && $password) {//REQUETE PREPARE POUR LUTTER CTRE LES INJECTIONS SQL
        //var_dump("ok");die;
    //si l'utilisateur existe
            $userManager = new UtilisateurManager();
            $utilisateur = $userManager->checkUserExists($email);

        if($utilisateur){
        // var_dump($utilisateur);die;
            $hash = $utilisateur->getPassword();

        if(password_verify($password, $hash)){//VERIFICATION DU MDP
            $_SESSION["utilisateur"] = $utilisateur; //on stocke dans un tableau SESSION l'intégralité des infos du user
                header("Location:index.php?ctrl=home&action=index");//SI CONNEXION REUSSIE: REDIRECTION VERS PAGE D ACCUEIL
                exit;  
                    
        } else {
    // Erreur d'adresse mail ou de mot de passe
                header("Location: index.php?ctrl=security&action=login");
        exit;
                }
        } else {
    // Utilisateur introuvable
                header("Location: index.php?security&action=login");
        exit;
        }
    }
    // Afficher le formulaire de connexion
                }
        
            return [
            "view" => VIEW_DIR . "connexion/login.php",
            "meta_description" => "Formulaire de connexion"
        ];
    }
    
    // AFFICHER LE COMPTE D'UN UTILISATEUR CONNECTÉ
    public function monCompte(){
        if(Session::getUtilisateur()) {
            $id_utilisateur = Session::getUtilisateur()->getId();
            $utilisateurManager = new UtilisateurManager();
            $utilisateur = $utilisateurManager->findOneById($id_utilisateur);
        } else {
            $this->redirectTo("connexion", "login.php");
        }
        //Appel de la méthode pour récupérer les réservations de l'utilisateur connecté.
        $reserverManager = new ReserverManager();
        $reservations = $reserverManager->findReservationsByUser($id_utilisateur);

        return [
            "view" => VIEW_DIR . "connexion/detailsUtilisateur.php",
            "meta_description" => "Mon compte",
            "data" => [
                "utilisateur" => $utilisateur,
                "reservations" =>$reservations// Rajout de la variable $reservations dans le tableau data
            ]
        ];
    }
    // MISE EN PLACE DE LA FONCTION LOGOUT
    public function logout () {
        session_unset();// Supprimer toutes les données de la session
    // Redirection après la déconnexion
        header("Location: index.php");
        exit;
        }

    //CREATION DE LA FONCTION UPDATE INFO POUR MODIFIER LES INFOS PERSORNELLES
    public function updateInfo() {
    //On vérifie si l'utilisateur est connecté
    if(Session::getUtilisateur()) {
        //On vérifie si le formulaire de mise à jour a été soumis
        if(isset($_POST["submitUpdate"])) {
        //On filtre et nettoie les données saisies par l'utilisateur
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //On vérifie si le pseudo et l'email et le MDP sont renseignés 
            if($pseudo && $email && $password) {
                //On récupère l'ID de l'utilisateur connecté 
                $id_utilisateur = Session::getUtilisateur()->getId();
                //On récupère les informations de l'utilisateur à partir de l'ID
                $utilisateurManager = new UtilisateurManager();
                $utilisateur = $utilisateurManager->findOneById($id_utilisateur);
                //On met à jour le pseudo et l'email de l'utilisateur
                $utilisateur->setPseudo($pseudo);
                $utilisateur->setEmail($email);
                $utilisateur->setPassword(password_hash($password, PASSWORD_DEFAULT));
                //On met à jour les informations de l'utilisateur dans la base de données
                $utilisateurManager->update($utilisateur);

                 // Message de confirmation de la modification
                 Session::addFlash("success", "Vos données personnelles ont été modifiées avec succès.");
                
                 // Redirection vers la page de "mon compte" après la modification
                header("Location: index.php?ctrl=security&action=monCompte");
                exit;
            }
        }
    } else {
        $this->redirectTo("connexion", "login.php");
    }
}
}



    
    

