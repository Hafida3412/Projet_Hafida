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
        // On vérifie si le formulaire d'inscription a été soumis    
        if (isset($_POST["submitRegister"])) {           
            // On filtre les champs du formulaire d'inscription:
             $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
             $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $consentement = isset($_POST['consentement']); // On vérifie si la case à cocher a été cochée

        // On vérifie que le consentement est donné
        if (!$consentement) {
            Session::addFlash("error", "Vous devez accepter la politique de confidentialité.");
            header("Location: index.php?ctrl=security&action=register");
            exit;
        }

            // Définition d'une regex pour le mot de passe
            // Au moins 12 caractères, 1 lettre majuscule, 1 lettre minuscule, 1 chiffre
             $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{12,}$/"; 

        // On vérifie la validité des filtres
        if ($pseudo && $nom && $prenom && $email && $pass1 && $pass2) {
        //var_dump("ok");die;
             $userManager = new UtilisateurManager();
             //création de la function checkUserExists dans utilisateurManager pour vérifier si l'utilisateur existe
             $utilisateur = $userManager->checkUserExists($email);
        // Si l'utilisateur existe
        if ($utilisateur) {
            Session::addFlash("error", "Cet email est déjà utilisé.");
            header("Location: index.php?ctrl=security&action=register");
            exit;
        } else {
        // Vérification que les mots de passe sont identiques et que le mot de passe respecte la regex
        if ($pass1 === $pass2 && preg_match($passwordRegex, $pass1)) {
            // Ajout d'un nouvel utilisateur via le gestionnaire d'utilisateurs (userManager)
            $userManager->add([
                "pseudo" => $pseudo,// Le pseudo de l'utilisateur, utilisé comme nom d'affichage
                "nom" => $nom,
                "prenom" => $prenom,
                // L'adresse email de l'utilisateur, utilisée pour l'authentification et les notifications
                "email" => $email,
                // Le mot de passe de l'utilisateur, haché pour assurer la sécurité
                // PASSWORD_DEFAULT utilise l'algorithme de hachage le plus sécurisé vers lequel PHP peut évoluer
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
            "meta" => "Formulaire d'inscription",
            "title" => "Formulaire d'inscription"
        ];
    }

//MISE EN PLACE DE LA FONCTION SE CONNECTER
/*Affiche la vue du formulaire de connexion et gère l'authentification*/
    public function login() {
        if (isset($_POST["submitLogin"])) {
            // PROTECTION XSS (=FILTRES)
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            // Vérification de la validité du reCAPTCHA
        if (empty($_POST['g-recaptcha-response'])) {
            Session::addFlash("error", "Veuillez cocher la case reCAPTCHA.");
            return [
                "view" => VIEW_DIR . "connexion/login.php",
                "meta" => "Formulaire de connexion",
                "title" => "Formulaire de connexion"
            ];
        }
            // Définition d'une regex pour le mot de passe
            $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{12,}$/"; 
            // Au moins 12 caractères, 1 lettre majuscule, 1 lettre minuscule, 1 chiffre
    
            // Vérification que l'email et le mot de passe existent
            if ($email && $password) {
                // Vérification du mot de passe avec la regex
                if (!preg_match($passwordRegex, $password)) {
                    Session::addFlash("error", "Le mot de passe doit contenir au moins 12 caractères, 
                    incluant une lettre majuscule, une lettre minuscule et un chiffre.");
                    return [
                        "view" => VIEW_DIR . "connexion/login.php",
                        "meta" => "Formulaire de connexion",
                        "title" => "Formulaire de connexion"
                    ];
                }
                
            // REQUETE PREPARE POUR LUTTER CONTRE LES INJECTIONS SQL
                $userManager = new UtilisateurManager();
                $utilisateur = $userManager->checkUserExists($email);
    
            // Si l'utilisateur existe
                if ($utilisateur) {
                    $hash = $utilisateur->getPassword();//appelle la méthode getPassword() de l'objet $utilisateur.
                    // getPassword retourne la version hachée du MDP
    
            // VERIFICATION DU MDP
            // On vérifie si le mot de passe fourni correspond au hachage stocké en utilisant la fonction password_verify
                if (password_verify($password, $hash)) {
            // Le mot de passe est correct, on peut procéder à l'authentification de l'utilisateur

            // On stocke dans une SESSION l'intégralité des infos de l'utilisateur
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
            "meta" => "Formulaire de connexion",
            "title" => "Formulaire de connexion"
        ];
    }
    
    
// AFFICHER LE COMPTE D'UN UTILISATEUR CONNECTÉ
    public function monCompte(){
        // On vérifie si un utilisateur est connecté en utilisant la session
        if(Session::getUtilisateur()) {
            // Récupèration de l'identifiant de l'utilisateur connecté
            $id_utilisateur = Session::getUtilisateur()->getId();
            // Création d'une instance du manager des utilisateurs
            $utilisateurManager = new UtilisateurManager();
            // Récupère les informations de l'utilisateur à partir de son ID
            $utilisateur = $utilisateurManager->findOneById($id_utilisateur);
        } else {
            // Si aucun utilisateur n'est connecté, redirection vers la page de connexion
            $this->redirectTo("connexion", "login.php");
        }
        //Appel de la méthode pour récupérer les réservations de l'utilisateur connecté.
        $reserverManager = new ReserverManager();
        $reservations = $reserverManager->findReservationsByUser($id_utilisateur);

        return [
            "view" => VIEW_DIR . "connexion/detailsUtilisateur.php",
            "meta" => "Mon compte",
            "title" => "Mon compte",
            "data" => [
                "utilisateur" => $utilisateur,
                "reservations" =>$reservations// Rajout de la variable $reservations dans le tableau data
            ]
        ];
    }

// MISE EN PLACE DE LA FONCTION LOGOUT
/* On déconnecte l'utilisateur */

    public function logout () {
        session_unset();// Suppression de toutes les données de la session
    // Redirection après la déconnexion
        header("Location: index.php");
        exit;
    }

//CREATION DE LA FONCTION UPDATE INFO POUR MODIFIER LES INFOS PERSONNELLES
    public function updateInfo() {
    //On vérifie si l'utilisateur est connecté
    if(Session::getUtilisateur()) {
        //On vérifie si le formulaire de mise à jour a été soumis
        if(isset($_POST["submitUpdate"])) {
        //On filtre et nettoie les données saisies par l'utilisateur
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //On vérifie si le pseudo et l'email sont renseignés 
            // Vérification si les valeurs sont renseignées
            if($pseudo && $email) {
                // Récupération de l'ID de l'utilisateur connecté 
                $id_utilisateur = Session::getUtilisateur()->getId();

                // Récupération des informations de l'utilisateur
                $utilisateurManager = new UtilisateurManager();
                $utilisateur = $utilisateurManager->findOneById($id_utilisateur);

                // Mise à jour du pseudo et de l'email de l'utilisateur
                $utilisateur->setPseudo($pseudo);
                $utilisateur->setEmail($email);

                // Mise à jour du mot de passe uniquement s'il a été saisi
                if(!empty($password)) {
                    $utilisateur->setPassword(password_hash($password, PASSWORD_DEFAULT));
                }

                // Mise à jour des informations de l'utilisateur dans la base de données
                $utilisateurManager->update($utilisateur);

                // Message de confirmation de la modification
                Session::addFlash("success", "Vos données personnelles ont été modifiées avec succès.");
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
/* Affiche le formulaire pour le mot de passe oublié*/

public function forgotPassword() {
    // Ici, l'utilisateur peut saisir son email
    if (isset($_POST["submitForgotPassword"])) {
        // On filtre l'email
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

        // Vérifie si une adresse email est fournie
        if ($email) {
            // Crée une instance de UtilisateurManager pour gérer les utilisateurs
            $userManager = new UtilisateurManager();
            //Vérifie si l'utilisateur associé à l'email existe dans la base de données
            // La méthode checkUserExists retourne les informations de l'utilisateur si trouvé
            $utilisateur = $userManager->checkUserExists($email);

            if ($utilisateur) {// Vérifie si la variable $utilisateur n'est pas vide ou nulle
                // Cela permet de s'assurer qu'il y a effectivement un utilisateur à traiter.
            
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
        "meta" => "Récupération du mot de passe",
        "title" => "Récupération du mot de passe"
    ];
}

// MISE EN PLACE DE LA FONCTION RÉINITIALISER LE MOT DE PASSE
/*Gère la réinitialisation du mot de passe*/

public function resetPassword() {
    $utilisateur = Session::getUtilisateur(); // On récupère l'utilisateur en session

    // Vérifie si la variable $utilisateur est vide ou nulle
    if (!$utilisateur) {
        // Si l'utilisateur n'est pas connecté, on ajoute un message d'erreur à la session
        Session::addFlash("error", "Aucun utilisateur connecté.");
        // Redirige l'utilisateur vers la page de connexion
        header("Location: index.php?ctrl=security&action=login");
        exit; // Termine le script afin d'éviter toute exécution de code supplémentaire
    }

    if (isset($_POST["submitResetPassword"])) {
        // On filtre le nouveau mot de passe et la confirmation de mot de passe
        $newPassword = filter_input(INPUT_POST, "newPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Vérification que les mots de passe correspondent
        if ($newPassword && $confirmPassword) {// On vérifie si les 2 lignes sont bien définies
            if ($newPassword === $confirmPassword) {// Comparaison des 2 MDP
                $userManager = new UtilisateurManager();// On crée une instance de la classe UtilisateurManager
                // Mise à jour/réinitialisation du mot de passe
                /*Cette fonction prend deux informations :
                L'id de l'utilisateur et le nouveau MDP, qui est sécurisé/chiffré grâce à la fonction password_hash*/
                $userManager->updatePassword($utilisateur->getId(), password_hash($newPassword, PASSWORD_DEFAULT));
                Session::addFlash("success", "Votre mot de passe a été réinitialisé avec succès!");

                // Nettoyage de la session après réinitialisation
                // Déconnexion de l'utilisateur
                Session::setUtilisateur(null); 
                header("Location: index.php?ctrl=security&action=login");
                exit;
            } else {
                Session::addFlash("error", "Les mots de passe ne correspondent pas.");
            }
        } else {
            Session::addFlash("error", "Veuillez entrer un mot de passe.");
        }
    }

    return [
        "view" => VIEW_DIR . "connexion/resetPassword.php",
        "meta" => "Réinitialiser le mot de passe",
        "title" => "Réinitialiser le mot de passe"
    ];
}

public function supprimerCompte() {
    // Vérifie si l'utilisateur est connecté
    $utilisateur = Session::getUtilisateur();
    
    if (!$utilisateur) {
        Session::addFlash('error', 'Vous devez être connecté pour supprimer votre compte.');
        header('Location: index.php?ctrl=security&action=login');
        exit;
    }

    // Si le formulaire de confirmation a été soumis
    if (isset($_POST['confirmDeletion'])) {
        $utilisateurManager = new UtilisateurManager();
        
        // Suppression de l'utilisateur
        if ($utilisateurManager->delete($utilisateur->getId())) {
            Session::addFlash('success', 'Votre compte a été supprimé avec succès.');
            // Déconnexion l'utilisateur
            Session::setUtilisateur(null); 
            header('Location: index.php');
            exit;
        } else {
            Session::addFlash('error', 'Erreur lors de la suppression de votre compte.');
            header('Location: index.php?ctrl=security&action=monCompte');
            exit;
        }
    }

    return [
        "view" => VIEW_DIR . "connexion/supprimerCompte.php", // Créez ce fichier pour gérer la confirmation.
        "meta" => "Confirmation de la suppression du compte",
        "title" => "Confirmation de la suppression du compte"
    ];
}
}

    
    

