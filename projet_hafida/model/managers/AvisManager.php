<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class AvisManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Avis";
    protected $tableName = "avis";

    public function __construct(){
        parent::connect();
    }
    public function findAllByLogementId($id){
        $sql = "SELECT * 
                FROM avis 
                WHERE logement_id = :id";
    
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            "Model\Entities\Avis"
        );
    }
}