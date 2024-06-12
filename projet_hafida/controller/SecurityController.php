<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UtilisateurManager;


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
 
                     // var_dump("ok");die;
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
                             ]);
 
                             //REDIRECTION APRES L INSCRIPTION
                             header("Location: index.php?ctrl=security&action=login");
                             exit;
                         } else {
                             header("Location: index.php?ctrl=security&action=register");
                             exit;
                             // $this->redirectTo("security","register")
                         }
                     }
                 }
             }
              return [
                 "view" => VIEW_DIR . "connexion/register.php",
                 "meta_description" => "Formulaire d'inscription"
             ];
     }  
    
   
   
   
   
   
   
   
    public function login () {}
    public function logout () {}
}