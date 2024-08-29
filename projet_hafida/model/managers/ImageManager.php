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

    public function findImagesByLogement($logementId) {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE logement_id = :logementId";
        return $this->getMultipleResults(
            DAO::select($sql, ['logementId' => $logementId]), 
            $this->className
        );
    }   
}