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
    
    public function findReservationByAnnonce($annonce) {
    $sql = "SELECT *
            FROM ".$this->tableName." r
            WHERE annonce_id = :annonceId";

    return $this->getSingleScalarResult(
        DAO::select($sql, ['annonceId' => $annonce], false)
    );
}
}