<?php
namespace App;

class Session{

    private static $annonces = ['error', 'success'];

    /**
    *   ajoute un message en session, dans la catégorie $ann
    */
    public static function addFlash($ann, $msg){
        $_SESSION[$ann] = $msg;
    }

    /**
    *   renvoie un message de la catégorie $ann, s'il y en a !
    */
    public static function getFlash($ann){
        
        if(isset($_SESSION[$ann])){
            $msg = $_SESSION[$ann];  
            unset($_SESSION[$ann]);
        }
        else $msg = "";
        
        return $msg;
    }

    /**
    *   met un user dans la session (pour le maintenir connecté)
    */
    public static function setUser($utilisateur){
        $_SESSION["utilisateur"] = $utilisateur;
    }

    public static function getUser(){
        return (isset($_SESSION['utilisateur'])) ? $_SESSION['utilisateur'] : false;
    }

    public static function isAdmin(){
        // attention de bien définir la méthode "hasRole" dans l'entité User en fonction de la façon dont sont gérés les rôles en base de données
        if(self::getUser() && self::getUser()->hasRole("ROLE_ADMIN")){
            return true;
        }
        return false;
    }
}