<?php
namespace App;

/*
    En programmation orientée objet, une classe abstraite est une classe qui ne peut 
    pas être instanciée directement. 
    Cela signifie que vous ne pouvez pas créer un objet directement à partir d'une 
    classe abstraite.
    Les classes abstraites : 
    -- peuvent contenir à la fois des méthodes abstraites (méthodes sans implémentation)
     et des méthodes concrètes (méthodes avec implémentation).
    -- peuvent avoir des propriétés (variables) avec des valeurs par défaut.
    -- une classe peut étendre une seule classe abstraite.
    -- permettent de fournir une certaine implémentation de base.
*/

abstract class AbstractController{
    /*
     La méthode index() est une méthode abstraite qui doit être implémentée par les 
     classes filles.
    */
    public function index() {}

    /*
    La méthode redirectTo() prend en paramètre un contrôleur, une action et un 
    identifiant et redirige l'utilisateur vers une nouvelle URL en fonction de 
    ces paramètres.
    */
    public function redirectTo($ctrl = null, $action = null, $id = null){

        $url = $ctrl ? "?ctrl=".$ctrl : "";
        $url.= $action ? "&action=".$action : "";
        $url.= $id ? "&id=".$id : "";

        header("Location: $url");
        die();
    }

    /*
    La méthode restrictTo() vérifie si l'utilisateur actuellement connecté a un 
    rôle spécifique, et le redirige vers la page de connexion s'il n'a pas le rôle 
    requis.
    */
    public function restrictTo($role){
        
        if(!Session::getUtilisateur() || !Session::getUtilisateur()->hasRole($role)){
            $this->redirectTo("security", "login");
        }
        return;
    }

}
/* 
Ce code est utile pour gérer la redirection des utilisateurs et les restrictions d'accès 
en fonction des rôles.
*/