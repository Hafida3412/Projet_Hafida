<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;


class ImageManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Image";
    protected $tableName = "image";

    public function __construct(){
        parent::connect();
    }

    public function findImagesByLogement($logementID) {
    $sql = "SELECT * FROM image WHERE logement_id = :logement_id";
    return DAO::select($sql, ['logement_id' => $logementID], true); // Vérifiez que vous renvoyez les résultats avec 'true'
}

    
    
}