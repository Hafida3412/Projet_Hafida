<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class LogementManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Logement";
    protected $tableName = "logement";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les logements d'une annonce spécifique (par son id)
    public function findlogementsByAnnonces($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.annonce_id = :id";
        
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
         }
    
}

