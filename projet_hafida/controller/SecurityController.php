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
    
    // Définir une regex pour le mot de passe
    $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/"; // Au moins 12 caractères, 1 lettre majuscule, 1 lettre minuscule, 1 chiffre

    // Vérifier la validité des filtres
    if ($pseudo && $email && $pass1 && $pass2) {
    //var_dump("ok");die;
             $userManager = new UtilisateurManager();
             $utilisateur = $userManager->checkUserExists($email);//création de la function checkUserExists dans utilisateurManager pour vérifier si l'utilisateur existe
    //SI L UTILISATEUR EXISTE
    if ($utilisateur) {
        Session::addFlash("error", "Cet email est déjà utilisé.");
        header("Location: index.php?ctrl=security&action=register");
        exit;
    } else {
        // Vérification que les mots de passe sont identiques et que le mot de passe respecte la regex
        if ($pass1 === $pass2 && preg_match($passwordRegex, $pass1)) {
            $userManager->add([
                "pseudo" => $pseudo,
                "email" => $email,
                "password" => password_hash($pass1, PASSWORD_DEFAULT)
            ]);

    // Redirection après l'inscription
    header("Location: index.php?ctrl=security&action=login");
    exit;
} else {
    Session::addFlash("error", "Le mot de passe doit contenir au moins 12 caractères, incluant une lettre majuscule, une lettre minuscule et un chiffre.");
    header("Location: index.php?ctrl=security&action=register");
    exit;
}
}
} else {
// Redirection vers le formulaire d'inscription si des champs sont manquants
Session::addFlash("error", "Tous les champs sont obligatoires.");
header("Location: index.php?ctrl=security&action=register");
exit;
}
}

return [
"view" => VIEW_DIR . "connexion/register.php",
"meta_description" => "Formulaire d'inscription"
];
}

    //MISE EN PLACE DE LA FONCTION SE CONNECTER
    public function login() {
        if (isset($_POST["submitLogin"])) {
            // PROTECTION XSS (=FILTRES)
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            // Définir une regex pour le mot de passe
            $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{12,}$/"; // Au moins 12 caractères, 1 lettre majuscule, 1 lettre minuscule, 1 chiffre
    
            // Vérifier que l'email et le mot de passe existent
            if ($email && $password) {
                // Vérification du mot de passe avec la regex
                if (!preg_match($passwordRegex, $password)) {
                    Session::addFlash("error", "Le mot de passe doit contenir au moins 12 caractères, incluant une lettre majuscule, une lettre minuscule et un chiffre.");
                    return [
                        "view" => VIEW_DIR . "connexion/login.php",
                        "meta_description" => "Formulaire de connexion"
                    ];
                }
                
                // REQUETE PREPARE POUR LUTTER CONTRE LES INJECTIONS SQL
                $userManager = new UtilisateurManager();
                $utilisateur = $userManager->checkUserExists($email);
    
                // Si l'utilisateur existe
                if ($utilisateur) {
                    $hash = $utilisateur->getPassword();
    
                    // VERIFICATION DU MDP
                    if (password_verify($password, $hash)) {
                        // On stocke dans une SESSION l'intégralité des infos du user
                        $_SESSION["utilisateur"] = $utilisateur; 
                        // SI CONNEXION REUSSIE: REDIRECTION VERS PAGE D'ACCUEIL
                        header("Location:index.php?ctrl=home&action=index");
                        exit;
                    } else {
                        Session::addFlash("error", "Erreur d'adresse mail ou de mot de passe.");
                    }
                } else {
                    Session::addFlash("error", "Utilisateur introuvable.");
                }
            } else {
                Session::addFlash("error", "Tous les champs sont obligatoires.");
            }
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

// MISE EN PLACE DE LA FONCTION MOT DE PASSE OUBLIÉ
public function forgotPassword() {
    // Ici, l'utilisateur peut saisir son email
    if (isset($_POST["submitForgotPassword"])) {
        // Filtrer l'email
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        if ($email) {
            $userManager = new UtilisateurManager();
            $utilisateur = $userManager->checkUserExists($email);

            if ($utilisateur) {
                // On stocke l'ID utilisateur dans la session pour le réinitialiser plus tard
                Session::setUtilisateur($utilisateur);

                // Redirection vers la page de réinitialisation
                header("Location: index.php?ctrl=security&action=resetPassword");
                exit;
            } else {
                Session::addFlash("error", "Email introuvable.");
            }
        } else {
            Session::addFlash("error", "Veuillez entrer une adresse email valide.");
        }
    }

    return [
        "view" => VIEW_DIR . "connexion/forgotPassword.php",
        "meta_description" => "Récupération du mot de passe"
    ];
}

// MISE EN PLACE DE LA FONCTION RÉINITIALISER LE MOT DE PASSE
public function resetPassword() {
    $utilisateur = Session::getUtilisateur(); // Récupérer l'utilisateur en session

    if (!$utilisateur) {
        Session::addFlash("error", "Aucun utilisateur connecté.");
        header("Location: index.php?ctrl=security&action=login");
        exit;
    }

    if (isset($_POST["submitResetPassword"])) {
        // Filtrer le nouveau mot de passe
        $newPassword = filter_input(INPUT_POST, "newPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($newPassword) {
            $userManager = new UtilisateurManager();
            // Mettre à jour le mot de passe
            $userManager->updatePassword($utilisateur->getId(), password_hash($newPassword, PASSWORD_DEFAULT));
            Session::addFlash("success", "Votre mot de passe a été réinitialisé avec succès!");

            // Nettoyer la session
            Session::setUtilisateur(null); // Clear user session after resetting password
            header("Location: index.php?ctrl=security&action=login");
            exit;
        } else {
            Session::addFlash("error", "Veuillez entrer un mot de passe.");
        }
    }

    return [
        "view" => VIEW_DIR . "connexion/resetPassword.php",
        "meta_description" => "Réinitialiser le mot de passe"
    ];
}

}



    
    

