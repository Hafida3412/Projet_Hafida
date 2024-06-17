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
  
    // requete qui récupère la liste des logements de l'utilisateur connecté
    public function listLogementsByUser($id){
        $sql = "SELECT * 
        FROM ".$this->tableName." 
        WHERE utilisateur_id = :id";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );

    }

    public function addLogement($data){
        $keys = array_keys($data);
        $values = array_values($data);
    
        $sql = "INSERT INTO ".$this->tableName."
                (".implode(',', $keys).") 
                VALUES
                ('".implode("','",$values)."')";
    
        try{
            return DAO::insert($sql);
        }
        catch(\PDOException $e){
            echo $e->getMessage();
            die();
        }
    }

}
    



