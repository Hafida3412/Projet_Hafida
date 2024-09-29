<?php
namespace Controller; // Déclaration du namespace pour organiser le cod

use App\AbstractController; // Importation de la classe AbstractController
use App\ControllerInterface; // Importation de l'interface ControllerInterface
use Model\Managers\UtilisateurManager; /* Importation du gestionnaire UtilisateurManager qui interagit 
avec les utilisateurs*/

// Déclaration de la classe HomeController qui étend AbstractController et implémente ControllerInterface
class HomeController extends AbstractController implements ControllerInterface {

    // Méthode principale du controller, généralement utilisée pour afficher la page d'accueil
    public function index(){
        return [
            "view" => VIEW_DIR."home.php", // Chemin de la vue à afficher
            "meta_description" => "Page d'accueil" // Description pour le SEO
        ];
    }
    
    //Méthode pour afficher la liste des utilisateurs
    public function users(){
        // Restriction d'accès pour s'assurer que l'utilisateur a le rôle approprié
        $this->restrictTo("ROLE_USER");

         // Création d'une instance du gestionnaire d'utilisateurs
        $manager = new UtilisateurManager();
        // Récupération de tous les utilisateurs triés par date d'inscription (DESC pour décroissant)
        $users = $manager->findAll(['register_date', 'DESC']);

        return [
            "view" => VIEW_DIR."security/users.php", // Chemin de la vue à afficher pour la liste des utilisateurs
            "meta_description" => "Liste des utilisateurs", // Description pour le SEO
            "data" => [ 
                "utilisateurs" => $users // Données des utilisateurs à passer à la vue
            ]
        ];
    }

}