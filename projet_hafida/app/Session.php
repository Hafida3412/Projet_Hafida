<?php
namespace App;

class Session{

    // Déclaration d'un tableau statique contenant les types de messages de notification
    private static $annonces = ['error', 'success'];

    /**
    *   Ajoute un message en session, dans la catégorie spécifiée ($ann).
    *   @param string $ann - La catégorie du message (ex: 'error', 'success')
    *   @param string $msg - Le message à stocker en session
    */

    public static function addFlash($ann, $msg){
         // Stocke le message dans la session sous la clé représentant sa catégorie
        $_SESSION[$ann] = $msg;
    }

    /**
    *   Récupère un message de la catégorie spécifiée ($ann) stocké en session,
    *   et le supprime ensuite de la session. 
    *   @param string $ann - La catégorie du message à récupérer
    *   @return string - Le message récupéré ou une chaîne vide s'il n'y en a pas
    */

    public static function getFlash($ann){
        // Vérifie si un message existe dans la session
        if(isset($_SESSION[$ann])){
            $msg = $_SESSION[$ann];  // Récupère le message
            unset($_SESSION[$ann]);  // Supprime le message de la session
        }
        else $msg = ""; // Si aucun message n'existe, définit $msg comme une chaîne vide
        
        return $msg; // Retourne le message (ou chaîne vide)
    }

    /**
    *   Stocke un utilisateur dans la session pour maintenir sa connexion.
    *   @param mixed $utilisateur - L'utilisateur à stocker en session
    */

    public static function setUtilisateur($utilisateur){
        // Stocke l'utilisateur dans la session sous la clé "utilisateur"
        $_SESSION["utilisateur"] = $utilisateur;
    }

   /**
    *   Récupère l'utilisateur actuellement connecté à partir de la session.
    *   @return mixed - L'utilisateur connecté ou false s'il n'y a pas d'utilisateur
    */

    public static function getUtilisateur(){
        // Vérifie si un utilisateur est stocké dans la session
        return (isset($_SESSION['utilisateur'])) ? $_SESSION['utilisateur'] : false;
    }

     /**
    *   Vérifie si l'utilisateur connecté a un rôle d'administrateur.
    *   @return bool - Retourne true si l'utilisateur est un admin, sinon false
    */
    public static function isAdmin(){
        /* attention de bien définir la méthode "hasRole" dans l'entité User 
        en fonction de la façon dont sont gérés les rôles en base de données*/
        if(self::getUtilisateur() && self::getUtilisateur()->hasRole("ROLE_ADMIN")){
            return true; // L'utilisateur est connecté et a le rôle d'admin
        }
        return false;// L'utilisateur n'est pas admin
    }
}