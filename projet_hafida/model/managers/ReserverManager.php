<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class ReserverManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Reserver";
    protected $tableName = "reserver";

    public function __construct(){
        parent::connect();
    }
}