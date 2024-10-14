<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;


class ImageManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Image"; // Spécifie la classe d'entité Image
    protected $tableName = "image";  // Spécifie le nom de la table "image" dans la base de données

    public function __construct(){
         // Appelle le constructeur parent pour établir une connexion à la base de données
        parent::connect();
    }

    public function findImagesByLogement($logementId) {
         // Prépare la requête SQL pour sélectionner toutes les images associées à l'ID de logement fourni
        $sql = "SELECT * FROM " . $this->tableName . 
        " WHERE logement_id = :logementId";
        // Exécute la requête SQL et retourne les résultats multiples sous forme d'objets de la classe Image
        return $this->getMultipleResults(
            DAO::select($sql, ['logementId' => $logementId]), 
            $this->className
        );
    }   
}