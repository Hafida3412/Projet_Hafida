<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\AnnonceManager;
use Model\Managers\LogementManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        
        // créer une nouvelle instance de AnnonceManager
        $annonceManager = new AnnonceManager();
        // récupérer la liste de toutes les annonces grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $annonceManager->findAll(["name", "DESC"]);

        // le controller communique avec la vue "listAnnonces" (view) pour lui envoyer la liste des annonces (data)
        return [
            "view" => VIEW_DIR."forum/listAnnonces.php",
            "meta_description" => "Liste des annonces",
            "data" => [
                "annonces" => $annonces
            ]
        ];
    }

    public function listTopicsByCategory($id) {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }
}