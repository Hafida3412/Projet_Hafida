<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Managers\AnnonceManager;


class ReserverManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Reserver";
    protected $tableName = "reserver";

    public function __construct(){
        parent::connect();
    }

//Méthode pour récupérer les réservations pour chaque utilisateur
public function findReservationsByUser($id_utilisateur){
    $sql = "SELECT *
            FROM ".$this->tableName."
            WHERE utilisateur_id = :id";

    return $this->getMultipleResults(
        DAO::select($sql, ['id' => $id_utilisateur]),
        $this->className
    );
}

}